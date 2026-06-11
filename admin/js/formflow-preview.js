(function( $ ) {
	'use strict';

	$(function() {
        if ( ! $('#formflow-preview-container').length ) {
            return;
        }

        const previewContainer = $('#formflow-live-preview');
        const spamStatus = $('#formflow-spam-status');

        $(document).on('formflowGraphUpdated', function(e, data) {
            renderPreview(data.nodes, data.edges);
        });

        function renderPreview(nodes, edges) {
            previewContainer.empty();
            
            if (nodes.length === 0) {
                previewContainer.append('<div style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; color:#9ca3af; padding:2rem; text-align:center;"><span class="dashicons dashicons-layout" style="margin-bottom:0.5rem; font-size:2.25rem; width:2.25rem; height:2.25rem;"></span><p style="font-size:1.125rem;">Drag nodes onto the canvas to see your beautiful form preview here.</p></div>');
                return;
            }

            let formHtml = '<form class="formflow-preview-form" style="width:100%; max-width:28rem; margin:0 auto; background:#fff; border-radius:0.75rem; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); border:1px solid #f3f4f6; padding:2rem; box-sizing:border-box; display:flex; flex-direction:column; gap:1.5rem; transition:all 0.5s ease-in-out;" onsubmit="event.preventDefault();">';
            
            // Separate submit button and input nodes, exclude non-visual nodes
            let submitNodes = nodes.filter(n => n.type === 'submitButton');
            let inputNodes = nodes.filter(n => {
                if (n.type === 'submit' || n.type === 'submitButton') return false;
                
                // Exclude non-visual nodes (like Validation) if the registry flags them as such
                if (typeof formflowEditorData !== 'undefined' && 
                    formflowEditorData.registered_nodes && 
                    formflowEditorData.registered_nodes[n.type]) {
                    
                    let def = formflowEditorData.registered_nodes[n.type];
                    if (def.hasOwnProperty('is_visual') && !def.is_visual) {
                        return false;
                    }
                }
                return true;
            });

            // Filter out disconnected nodes (only render nodes that have at least one connection)
            let connectedIds = new Set();
            edges.forEach(edge => {
                connectedIds.add(edge.from);
                connectedIds.add(edge.to);
            });
            inputNodes = inputNodes.filter(n => connectedIds.has(n.id));

            // Compute connected validation nodes for HTML attribute injection
            let nodeValidations = {};
            nodes.forEach(n => nodeValidations[n.id] = []);
            
            edges.forEach(edge => {
                let fromNode = nodes.find(n => n.id === edge.from);
                let toNode = nodes.find(n => n.id === edge.to);
                
                if (fromNode && toNode) {
                    let fromDef = (typeof formflowEditorData !== 'undefined' && formflowEditorData.registered_nodes) ? formflowEditorData.registered_nodes[fromNode.type] : null;
                    let toDef = (typeof formflowEditorData !== 'undefined' && formflowEditorData.registered_nodes) ? formflowEditorData.registered_nodes[toNode.type] : null;
                    
                    let fromIsVal = fromDef && fromDef.category === 'validation';
                    let toIsVal = toDef && toDef.category === 'validation';
                    
                    if (fromIsVal && !toIsVal) {
                        nodeValidations[toNode.id].push(fromNode);
                    } else if (!fromIsVal && toIsVal) {
                        nodeValidations[fromNode.id].push(toNode);
                    }
                }
            });

            // Topological Sort (Kahn's Algorithm) with Y-coordinate secondary sorting
            let inDegree = {};
            let adjList = {};
            let validIds = new Set(inputNodes.map(n => n.id));

            inputNodes.forEach(n => {
                inDegree[n.id] = 0;
                adjList[n.id] = [];
            });

            edges.forEach(edge => {
                if (validIds.has(edge.from) && validIds.has(edge.to)) {
                    adjList[edge.from].push(edge.to);
                    inDegree[edge.to]++;
                }
            });

            let queue = inputNodes.filter(n => inDegree[n.id] === 0);
            let sortedInputs = [];

            while (queue.length > 0) {
                // Secondary sort: Nodes at the same depth should render top-to-bottom
                queue.sort((a, b) => a.y - b.y);
                
                let current = queue.shift();
                sortedInputs.push(current);

                adjList[current.id].forEach(neighborId => {
                    inDegree[neighborId]--;
                    if (inDegree[neighborId] === 0) {
                        queue.push(inputNodes.find(n => n.id === neighborId));
                    }
                });
            }

            // Fallback for cycles (append any remaining nodes sorted by Y)
            if (sortedInputs.length < inputNodes.length) {
                let remaining = inputNodes.filter(n => !sortedInputs.includes(n));
                remaining.sort((a, b) => a.y - b.y);
                sortedInputs = sortedInputs.concat(remaining);
            }

            // Reconstruct final array: sorted inputs + submit button
            let inputs = sortedInputs.concat(submitNodes);

            inputs.forEach((node, index) => {
                // Determine input type based on node.type ID
                let htmlType = 'text';
                if (node.type === 'emailField') htmlType = 'email';
                if (node.type === 'numberField') htmlType = 'number';
                if (node.type === 'passwordField') htmlType = 'password';
                if (node.type === 'telField') htmlType = 'tel';
                if (node.type === 'dateField') htmlType = 'date';
                if (node.type === 'timeField') htmlType = 'time';
                if (node.type === 'colorPicker') htmlType = 'color';
                if (node.type === 'fileUpload') htmlType = 'file';

                let baseInputStyle = "width:100%; box-sizing:border-box; padding:0.75rem 1rem; color:#374151; background:#f9fafb; border:1px solid #e5e7eb; border-radius:0.5rem; outline:none; transition:all 0.3s ease-in-out; font-family:inherit;";
                
                let label = node.fieldValues && node.fieldValues.label !== undefined ? node.fieldValues.label : (node.label || node.name || 'Field');
                let showLabel = node.fieldValues && node.fieldValues.showLabel !== undefined ? node.fieldValues.showLabel : true;
                if (node.type === 'submitButton') showLabel = false;
                let placeholder = node.fieldValues && node.fieldValues.placeholder !== undefined && node.fieldValues.placeholder.trim() !== '' ? node.fieldValues.placeholder : `Enter ${label.toLowerCase()}...`;
                
                let isRequired = node.fieldValues && node.fieldValues.required ? true : false;
                let validationAttrs = '';
                
                let validators = nodeValidations[node.id] || [];
                validators.forEach(v => {
                    let v_fv = v.fieldValues || {};
                    switch (v.type) {
                        case 'validateRequired':
                            isRequired = true;
                            break;
                        case 'validateMinLength':
                            if (v_fv.min !== undefined) validationAttrs += ` minlength="${v_fv.min}"`;
                            break;
                        case 'validateMaxLength':
                            if (v_fv.max !== undefined) validationAttrs += ` maxlength="${v_fv.max}"`;
                            break;
                        case 'validateMinValue':
                            if (v_fv.min !== undefined) validationAttrs += ` min="${v_fv.min}"`;
                            break;
                        case 'validateMaxValue':
                            if (v_fv.max !== undefined) validationAttrs += ` max="${v_fv.max}"`;
                            break;
                        case 'validateRegex':
                            if (v_fv.pattern) validationAttrs += ` pattern="${v_fv.pattern}"`;
                            break;
                    }
                });

                let isRequiredHtml = isRequired ? ' <span style="color:red;">*</span>' : '';
                let requiredAttr = isRequired ? 'required' : '';
                let combinedAttrs = (requiredAttr + ' ' + validationAttrs).trim();

                // Add staggered entrance animation via CSS classes
                let delay = index * 100;
                formHtml += `<div class="formflow-preview-field" style="animation-delay: ${delay}ms">`;
                
                if (showLabel) {
                    formHtml += `<label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.5rem;">${label}${isRequiredHtml}</label>`;
                }
                
                if (node.type === 'textareaField' || node.type === 'textarea') {
                    let rows = node.fieldValues && node.fieldValues.rows !== undefined ? node.fieldValues.rows : 4;
                    formHtml += `<textarea placeholder="${placeholder}" rows="${rows}" style="${baseInputStyle} resize:vertical;" ${combinedAttrs} readonly onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.5)';" onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';"></textarea>`;
                } else if (node.type === 'selectField') {
                    let optionsText = node.fieldValues && node.fieldValues.options !== undefined ? node.fieldValues.options : 'Option 1, Option 2, Option 3';
                    let optionsList = optionsText.split(',').map(s => s.trim()).filter(s => s);
                    let optionsHtml = optionsList.map(opt => `<option>${opt}</option>`).join('');
                    formHtml += `<select style="${baseInputStyle} appearance:none; cursor:not-allowed;" ${combinedAttrs} disabled>${optionsHtml || '<option>Select an option...</option>'}</select>`;
                } else if (node.type === 'checkboxField') {
                    let checkboxText = node.fieldValues && node.fieldValues.checkboxText !== undefined ? node.fieldValues.checkboxText : 'Check me';
                    formHtml += `<div style="display:flex; align-items:center; gap:0.75rem;"><input type="checkbox" style="width:1.25rem; height:1.25rem; border-radius:0.25rem; border:1px solid #d1d5db; cursor:not-allowed;" ${combinedAttrs} disabled /> <span style="color:#4b5563;">${checkboxText}</span></div>`;
                } else if (node.type === 'radioGroup') {
                    let optionsText = node.fieldValues && node.fieldValues.options !== undefined ? node.fieldValues.options : 'Option 1, Option 2';
                    let optionsList = optionsText.split(',').map(s => s.trim()).filter(s => s);
                    let radiosHtml = optionsList.map(opt => `<div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.5rem;"><input type="radio" style="width:1.25rem; height:1.25rem; border:1px solid #d1d5db; cursor:not-allowed;" ${combinedAttrs} disabled /> <span style="color:#4b5563;">${opt}</span></div>`).join('');
                    formHtml += radiosHtml;
                } else if (node.type === 'rangeSlider') {
                    formHtml += `<input type="range" style="width:100%; height:0.5rem; background:#e5e7eb; border-radius:0.5rem; cursor:not-allowed;" ${combinedAttrs} disabled />`;
                } else if (node.type === 'submitButton') {
                    let btnText = node.fieldValues && node.fieldValues.buttonText !== undefined ? node.fieldValues.buttonText : 'Submit Form';
                    let btnColor = node.fieldValues && node.fieldValues.buttonColor !== undefined ? node.fieldValues.buttonColor : '#2563eb';
                    let txtColor = node.fieldValues && node.fieldValues.textColor !== undefined ? node.fieldValues.textColor : '#ffffff';
                    formHtml += `<button type="button" style="width:100%; display:flex; justify-content:center; padding:0.75rem 1rem; border:none; border-radius:0.5rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.1); font-size:0.875rem; font-weight:700; color:${txtColor}; background:${btnColor}; cursor:pointer;">${btnText}</button>`;
                } else {
                    formHtml += `<input type="${htmlType}" placeholder="${placeholder}" style="${baseInputStyle}" ${combinedAttrs} readonly onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.5)';" onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';" />`;
                }
                
                formHtml += '</div>';
            });

            // No hardcoded submit button anymore

            formHtml += '</form>';
            
            // Inject custom keyframes for the staggered fade in if not exists
            if ($('#formflow-animations').length === 0) {
                $('head').append(`<style id="formflow-animations">
                    @keyframes fadeInPreview {
                        from { opacity: 0; transform: translateY(10px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .formflow-preview-field {
                        opacity: 0;
                        animation: fadeInPreview 0.5s ease-out forwards;
                    }
                </style>`);
            }

            previewContainer.append(formHtml);
        }
	});

})( jQuery );
