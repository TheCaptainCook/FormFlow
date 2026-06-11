(function( $ ) {
	'use strict';

	$(function() {
        if ( ! $('#formflow-editor-wrapper').length ) {
            return;
        }

        const container = $('#formflow-canvas-container');
        const svg = document.getElementById('formflow-connections');
        const graphDataInput = $('#formflow_graph_data');
        const scaleWrapper = $('#formflow-canvas-scale-wrapper');
        let currentZoom = 1;
        let panX = 0;
        let panY = 0;
        let isPanning = false;
        let panStart = {x: 0, y: 0};

        function updateCanvasTransform() { scaleWrapper.css('transform', `translate(${panX}px, ${panY}px) scale(${currentZoom})`); }
        function setZoom(zoom) { currentZoom = Math.max(0.2, Math.min(zoom, 3)); updateCanvasTransform(); }
        $('#formflow-zoom-in').on('click', function() { setZoom(currentZoom + 0.1); });
        $('#formflow-zoom-out').on('click', function() { setZoom(currentZoom - 0.1); });
        $('#formflow-zoom-reset').on('click', function() { currentZoom = 1; panX = 0; panY = 0; updateCanvasTransform(); });
        container.on('wheel', function(e) { if ($(e.target).closest('.formflow-node-body').length) return; e.preventDefault(); let delta = e.originalEvent.deltaY > 0 ? -0.05 : 0.05; setZoom(currentZoom + delta); });
        container.on('mousedown', function(e) { 
            if (!$(e.target).closest('.formflow-node, .formflow-port, .formflow-edge-delete, #formflow-zoom-controls').length) {
                selectedNodeId = null;
                scaleWrapper.find('.formflow-node').removeClass('selected');
                $('#formflow-delete-node-btn').prop('disabled', true);
            }
            if ($(e.target).closest('.formflow-node, .formflow-port, .formflow-edge-delete, #formflow-zoom-controls').length) return; 
            isPanning = true; panStart = { x: e.clientX - panX, y: e.clientY - panY }; container.css('cursor', 'grabbing'); 
        });
        $(document).on('mouseup', function(e) { if (isPanning) { isPanning = false; container.css('cursor', 'grab'); } });
        
        let nodes = [];
        let edges = [];
        let draggingNode = null;
        let draggingPort = null;
        let draggingPortType = null;
        let startPos = {x: 0, y: 0};
        let tempEdge = null;
        let selectedNodeId = null;

        // Load initial data
        let initialData = formflowEditorData.form_data;
        if (initialData) {
            try {
                let parsed = JSON.parse(initialData);
                nodes = parsed.nodes || [];
                edges = parsed.edges || [];
            } catch(e) {
                console.error("Could not parse form data", e);
            }
        }

        function renderGraph() {
            scaleWrapper.find('.formflow-node').remove();
            scaleWrapper.find('.formflow-edge-delete').remove();
            svg.innerHTML = '';

            nodes.forEach(node => {
                // Ensure config is attached if missing (e.g. from default PHP spawn)
                if (!node.config && formflowEditorData.registered_nodes[node.type]) {
                    node.config = formflowEditorData.registered_nodes[node.type];
                }

                let hasPriorityIn = false;
                let hasPriorityOut = false;
                let hasCondIn = false;
                let hasCondOut = false;
                
                if (node.config && node.config.config) {
                    let inputs = node.config.config.inputs || [];
                    let outputs = node.config.config.outputs || [];
                    
                    hasPriorityIn = inputs.includes('priority-in');
                    hasPriorityOut = outputs.includes('priority-out');
                    hasCondIn = inputs.includes('cond-in');
                    hasCondOut = outputs.includes('cond-out');
                }

                let fieldsHtml = '';
                if (node.config && node.config.config && node.config.config.fields) {
                    node.config.config.fields.forEach(field => {
                        // Compatibility for existing nodes that didn't have fieldValues yet
                        if (!node.fieldValues) node.fieldValues = {};
                        let value = node.fieldValues[field.name] !== undefined ? node.fieldValues[field.name] : field.default;
                        
                        fieldsHtml += `<div class="formflow-dynamic-field">
                            <label>${field.label}:</label>`;
                        
                        if (field.type === 'textarea') {
                            fieldsHtml += `<textarea class="dynamic-node-input" data-field="${field.name}" rows="2">${value}</textarea>`;
                        } else if (field.type === 'checkbox') {
                            fieldsHtml += `<input type="checkbox" class="dynamic-node-input" data-field="${field.name}" ${value ? 'checked' : ''} />`;
                        } else if (field.type === 'number') {
                            fieldsHtml += `<input type="number" class="dynamic-node-input" data-field="${field.name}" value="${value}" />`;
                        } else {
                            fieldsHtml += `<input type="text" class="dynamic-node-input" data-field="${field.name}" value="${value}" />`;
                        }
                        fieldsHtml += `</div>`;
                    });
                } else {
                    // Fallback for legacy
                    fieldsHtml = ``;
                }

                let isMinimized = node.minimized ? ' minimized' : '';
                let toggleIcon = node.minimized ? '<span class="dashicons dashicons-plus-alt2"></span>' : '<span class="dashicons dashicons-minus"></span>';
                let widthStyle = node.width ? `width: ${node.width}px;` : '';
                let isSelected = (node.id === selectedNodeId) ? ' selected' : '';

                let nodeHtml = `
                    <div class="formflow-node${isMinimized}${isSelected}" data-id="${node.id}" style="left: ${node.x}px; top: ${node.y}px; ${widthStyle}">
                        ${ hasPriorityIn ? '<div class="formflow-port port-top" data-port-type="priority-in" title="Priority Input"></div>' : ''}
                        ${ hasPriorityOut ? '<div class="formflow-port port-bottom" data-port-type="priority-out" title="Priority Output"></div>' : ''}
                        ${ hasCondOut ? '<div class="formflow-port port-right" data-port-type="cond-out" title="Conditional Output"></div>' : ''}
                        ${ hasCondIn ? '<div class="formflow-port port-left" data-port-type="cond-in" title="Conditional Input"></div>' : ''}
                        <div class="formflow-node-header">
                            <span class="formflow-node-title">${node.type.toUpperCase()}</span>
                        </div>
                        <div class="formflow-node-body" style="display: ${node.minimized ? 'none' : 'block'};">
                            ${fieldsHtml}
                        </div>
                    </div>
                `;
                scaleWrapper.append(nodeHtml);
            });

            edges.forEach(edge => {
                drawEdge(edge.from, edge.to, edge.fromPort, edge.toPort);
            });

            // Add ResizeObserver to handle native CSS resizing
            if (window.ResizeObserver) {
                const resizeObserver = new ResizeObserver(entries => {
                    let hasChanges = false;
                    for (let entry of entries) {
                        let nodeEl = $(entry.target);
                        let nodeId = nodeEl.data('id');
                        let nodeObj = nodes.find(n => n.id === nodeId);
                        
                        // Save the new width if it changed
                        let currentWidth = nodeEl.outerWidth();
                        if (nodeObj && (!nodeObj.width || Math.abs(nodeObj.width - currentWidth) > 2)) {
                            nodeObj.width = currentWidth;
                            hasChanges = true;
                        }

                        // Fix: Redraw all connected edges safely
                        scaleWrapper.find('.formflow-edge-delete').remove();
                        svg.innerHTML = '';
                        edges.forEach(edge => {
                            drawEdge(edge.from, edge.to, edge.fromPort, edge.toPort);
                        });
                    }
                    if (hasChanges) {
                        updateDataInput();
                    }
                });
                scaleWrapper.find('.formflow-node').each(function() {
                    resizeObserver.observe(this);
                });
            }

            updateDataInput();
        }

        function drawEdge(fromId, toId, fromPortType, toPortType) {
            let fromNode = container.find(`.formflow-node[data-id="${fromId}"]`);
            let toNode = container.find(`.formflow-node[data-id="${toId}"]`);
            
            if (fromNode.length && toNode.length) {
                fromPortType = fromPortType || 'cond-out';
                toPortType = toPortType || 'cond-in';

                let fromLeft = parseFloat(fromNode.css('left')) || 0;
                let fromTop = parseFloat(fromNode.css('top')) || 0;
                let fromWidth = fromNode.outerWidth() || 200;
                let fromHeight = fromNode.outerHeight() || 50;

                let fromPos = { x: 0, y: 0 };
                if (fromPortType === 'cond-out') { fromPos.x = fromLeft + fromWidth; fromPos.y = fromTop + fromHeight / 2; }
                else if (fromPortType === 'cond-in') { fromPos.x = fromLeft; fromPos.y = fromTop + fromHeight / 2; }
                else if (fromPortType === 'priority-out') { fromPos.x = fromLeft + fromWidth / 2; fromPos.y = fromTop + fromHeight; }
                else if (fromPortType === 'priority-in') { fromPos.x = fromLeft + fromWidth / 2; fromPos.y = fromTop; }

                let toLeft = parseFloat(toNode.css('left')) || 0;
                let toTop = parseFloat(toNode.css('top')) || 0;
                let toWidth = toNode.outerWidth() || 200;
                let toHeight = toNode.outerHeight() || 50;

                let toPos = { x: 0, y: 0 };
                if (toPortType === 'cond-out') { toPos.x = toLeft + toWidth; toPos.y = toTop + toHeight / 2; }
                else if (toPortType === 'cond-in') { toPos.x = toLeft; toPos.y = toTop + toHeight / 2; }
                else if (toPortType === 'priority-out') { toPos.x = toLeft + toWidth / 2; toPos.y = toTop + toHeight; }
                else if (toPortType === 'priority-in') { toPos.x = toLeft + toWidth / 2; toPos.y = toTop; }

                let midX = (fromPos.x + toPos.x) / 2;
                let midY = (fromPos.y + toPos.y) / 2;

                let cp1x = fromPos.x;
                let cp1y = fromPos.y;
                let cp2x = toPos.x;
                let cp2y = toPos.y;
                let offset = 50;

                if (fromPortType === 'cond-out') cp1x += offset;
                else if (fromPortType === 'cond-in') cp1x -= offset;
                else if (fromPortType === 'priority-out') cp1y += offset;
                else if (fromPortType === 'priority-in') cp1y -= offset;

                if (toPortType === 'cond-in') cp2x -= offset;
                else if (toPortType === 'cond-out') cp2x += offset;
                else if (toPortType === 'priority-in') cp2y -= offset;
                else if (toPortType === 'priority-out') cp2y += offset;

                let d = `M ${fromPos.x} ${fromPos.y} C ${cp1x} ${cp1y}, ${cp2x} ${cp2y}, ${toPos.x} ${toPos.y}`;

                let hitPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                hitPath.setAttribute('d', d);
                hitPath.setAttribute('class', 'connection-hitbox');
                hitPath.setAttribute('data-from', fromId);
                hitPath.setAttribute('data-to', toId);
                hitPath.setAttribute('data-from-port', fromPortType);
                hitPath.setAttribute('data-to-port', toPortType);
                svg.appendChild(hitPath);

                let path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', d);
                path.setAttribute('class', 'connection');
                if (fromPortType.includes('cond') || toPortType.includes('cond')) {
                    path.classList.add('conditional-edge');
                    path.style.stroke = '#e68e00';
                    path.style.strokeDasharray = '5,5';
                } else {
                    path.classList.add('priority-edge');
                    path.style.stroke = '#007cba';
                }
                path.setAttribute('data-from', fromId);
                path.setAttribute('data-to', toId);
                path.setAttribute('data-from-port', fromPortType);
                path.setAttribute('data-to-port', toPortType);
                svg.appendChild(path);

                let deleteBtn = $(`<div class="formflow-edge-delete" data-from="${fromId}" data-to="${toId}" data-from-port="${fromPortType}" data-to-port="${toPortType}" style="left: ${midX}px; top: ${midY}px;"><span class="dashicons dashicons-dismiss"></span></div>`);
                scaleWrapper.append(deleteBtn);
            }
        }

        function updateDataInput() {
            graphDataInput.val(JSON.stringify({nodes: nodes, edges: edges}));
            $(document).trigger('formflowGraphUpdated', [{nodes: nodes, edges: edges}]);
        }

        // --- Event Listeners ---

        // Modal Logic
        const modal = $('#formflow-node-modal');
        const grid = $('#formflow-node-wrapper');
        const registeredNodes = formflowEditorData.registered_nodes || {};

        $('#formflow-add-node-btn').on('click', function(e) {
            e.preventDefault();
            console.log("Add Node button clicked. Registered nodes:", registeredNodes);
            renderNodeGrid();
            modal.css('display', 'flex');
        });

        $('#formflow-delete-node-btn').on('click', function() {
            if (!selectedNodeId) return;
            nodes = nodes.filter(n => n.id !== selectedNodeId);
            edges = edges.filter(e => e.from !== selectedNodeId && e.to !== selectedNodeId);
            selectedNodeId = null;
            $('#formflow-delete-node-btn').prop('disabled', true);
            renderGraph();
            updateDataInput();
        });

        $('.formflow-modal-close').on('click', function() {
            modal.hide();
        });

        $('#formflow-node-search').on('input', function() {
            let term = $(this).val().toLowerCase();
            grid.find('.formflow-tier-section').each(function() {
                let hasVisible = false;
                $(this).find('.formflow-node-card').each(function() {
                    let name = $(this).data('name').toLowerCase();
                    let isVisible = name.includes(term);
                    $(this).toggle(isVisible);
                    if (isVisible) hasVisible = true;
                });
                $(this).toggle(hasVisible);
            });
        });

        function renderNodeGrid() {
            grid.empty();
            
            let groups = {};

            $.each(registeredNodes, function(id, node) {
                let cat = node.category || 'uncategorized';
                if (!groups[cat]) {
                    groups[cat] = [];
                }
                groups[cat].push(node);
            });

            const categoryMap = {
                'trigger': '1. Trigger / Entry Nodes',
                'input': '2. Input / Field Nodes',
                'validation': '3. Validation Nodes',
                'spam': '4. Spam Protection Nodes',
                'logic': '5. Logic & Flow Control Nodes',
                'transformation': '6. Data Transformation Nodes',
                'variable': '7. Variable Nodes',
                'action': '8. Action / Destination Nodes',
                'notification': '9. Notification Nodes',
                'storage': '10. Storage Nodes (File/Cloud)',
                'ui': '11. UI/UX Nodes',
                'integration': '12. Third-Party Integration Nodes',
                'debug': '13. Debug & Logging Nodes',
                'math': '14. Math & Calculation Nodes',
                'date': '15. Date & Time Nodes',
                'conditional': '16. Conditional / Comparison Nodes',
                'array': '17. Array/Collection Nodes',
                'http': '18. HTTP / API Nodes',
                'file': '19. File Processing Nodes',
                'output': '20. End / Output Nodes'
            };

            const categoryIcons = {
                'trigger': 'dashicons-controls-play',
                'input': 'dashicons-edit',
                'validation': 'dashicons-yes',
                'spam': 'dashicons-shield',
                'logic': 'dashicons-randomize',
                'transformation': 'dashicons-update',
                'variable': 'dashicons-database',
                'action': 'dashicons-external',
                'notification': 'dashicons-megaphone',
                'storage': 'dashicons-cloud',
                'ui': 'dashicons-desktop',
                'integration': 'dashicons-admin-plugins',
                'debug': 'dashicons-warning',
                'math': 'dashicons-calculator',
                'date': 'dashicons-calendar-alt',
                'conditional': 'dashicons-leftright',
                'array': 'dashicons-list-view',
                'http': 'dashicons-networking',
                'file': 'dashicons-media-document',
                'output': 'dashicons-flag'
            };

            let sortedCategories = Object.keys(categoryMap).filter(cat => groups[cat] && groups[cat].length > 0);
            Object.keys(groups).forEach(cat => {
                if (!categoryMap[cat]) {
                    sortedCategories.push(cat);
                }
            });

            sortedCategories.forEach(cat => {
                let catName = categoryMap[cat] || (cat.charAt(0).toUpperCase() + cat.slice(1) + ' Nodes');
                let catIcon = categoryIcons[cat] || 'dashicons-grid-view';
                
                let sectionHtml = `<div class="formflow-tier-section" data-category="${cat}">
                    <h3 class="formflow-sticky-header category-header-${cat}">
                        <span class="dashicons ${catIcon}"></span> ${catName}
                    </h3>
                    <div class="formflow-node-grid">`;

                groups[cat].sort((a, b) => {
                    if (a.is_accessible === b.is_accessible) {
                        return a.name.localeCompare(b.name);
                    }
                    return a.is_accessible ? -1 : 1;
                });

                groups[cat].forEach(node => {
                    let lockedClass = !node.is_accessible ? ' locked' : '';
                    let titleAttr = !node.is_accessible ? `title="Requires ${node.tier.toUpperCase()} tier"` : '';
                    
                    let tierNameStr = node.tier.charAt(0).toUpperCase() + node.tier.slice(1);
                    let starHtml = node.tier !== 'free' ? `<span class="dashicons dashicons-star-filled" style="font-size:12px; width:12px; height:12px; margin-right:3px;"></span>` : '';

                    sectionHtml += `
                        <div class="formflow-node-card${lockedClass}" data-id="${node.id}" data-name="${node.name}" ${titleAttr}>
                            <div class="formflow-node-card-header" style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom: 8px;">
                                <h4 style="margin:0; font-size:13px;">${node.name}</h4>
                                <span class="tier-label-${node.tier}" style="display:flex; align-items:center; font-size:10px;">${starHtml}${tierNameStr}</span>
                            </div>
                            <p class="formflow-node-desc" style="font-size: 11px; color: #666; margin: 0; line-height: 1.3;">${node.description || 'Standard input node.'}</p>
                        </div>
                    `;
                });

                sectionHtml += `</div></div>`;
                grid.append(sectionHtml);
            });
        }

        grid.on('click', '.formflow-node-card', function() {
            let id = $(this).data('id');
            let nodeData = registeredNodes[id];
            if (nodeData) {
                if (!nodeData.is_accessible) {
                    alert('This node is locked. Please upgrade to the ' + nodeData.tier.toUpperCase() + ' tier to use it.');
                    return;
                }
                addNode(nodeData.id, nodeData.name, nodeData);
            }
            modal.hide();
        });

        function addNode(type, label, config = null) {
            let initialFieldValues = {};
            if (config && config.config && config.config.fields) {
                config.config.fields.forEach(f => {
                    initialFieldValues[f.name] = f.default !== undefined ? f.default : '';
                });
            }

            nodes.push({
                id: 'n' + Date.now(),
                type: type,
                label: label,
                x: 50,
                y: 50,
                config: config,
                fieldValues: initialFieldValues
            });
            renderGraph();
        }

        // Node Selection
        container.on('mousedown', '.formflow-node', function(e) {
            if ($(e.target).closest('.formflow-port, .formflow-edge-delete').length) return;
            selectedNodeId = $(this).data('id');
            scaleWrapper.find('.formflow-node').removeClass('selected');
            $(this).addClass('selected');
            $('#formflow-delete-node-btn').prop('disabled', false);
        });

        // Node Dragging
        container.on('mousedown', '.formflow-node-header', function(e) {
            if($(e.target).closest('.formflow-node-controls').length) return;
            draggingNode = $(this).closest('.formflow-node');
            startPos = {
                x: ((e.clientX - container.offset().left) - panX) / currentZoom - draggingNode.position().left,
                y: ((e.clientY - container.offset().top + $(window).scrollTop()) - panY) / currentZoom - draggingNode.position().top
            };
            e.stopPropagation();
        });

        // Dynamic Fields Update
        container.on('input change', '.dynamic-node-input', function(e) {
            let id = $(this).closest('.formflow-node').data('id');
            let node = nodes.find(n => n.id === id);
            if (node) {
                let fieldName = $(this).data('field');
                let type = $(this).attr('type');
                
                if (type === 'checkbox') {
                    node.fieldValues[fieldName] = $(this).is(':checked');
                } else {
                    node.fieldValues[fieldName] = $(this).val();
                }
                
                updateDataInput();
            }
        });

        // Legacy Label Update (keep for fallback)
        container.on('input', '.node-label-input', function(e) {
            let id = $(this).closest('.formflow-node').data('id');
            let node = nodes.find(n => n.id === id);
            if (node) {
                node.label = $(this).val();
                updateDataInput();
            }
        });

        // Delete Node
        container.on('click', '.formflow-node-delete', function(e) {
            let id = $(this).closest('.formflow-node').data('id');
            let nodeObj = nodes.find(n => n.id === id);
            if (nodeObj && nodeObj.type === 'submitButton') return;
            
            nodes = nodes.filter(n => n.id !== id);
            edges = edges.filter(e => e.from !== id && e.to !== id);
            renderGraph();
        });

        // Toggle Minimize/Maximize Node
        container.on('click', '.formflow-node-toggle', function(e) {
            let id = $(this).closest('.formflow-node').data('id');
            let node = nodes.find(n => n.id === id);
            if (node) {
                node.minimized = !node.minimized;
                renderGraph();
            }
        });

        // Hover Edge to Delete
        container.on('mouseenter', 'path.connection-hitbox, .formflow-edge-delete', function() {
            let fromId = $(this).attr('data-from');
            let toId = $(this).attr('data-to');
            let fromPort = $(this).attr('data-from-port');
            let toPort = $(this).attr('data-to-port');
            container.find(`.formflow-edge-delete[data-from="${fromId}"][data-to="${toId}"][data-from-port="${fromPort}"][data-to-port="${toPort}"]`).addClass('visible');
            $(svg).find(`path.connection[data-from="${fromId}"][data-to="${toId}"][data-from-port="${fromPort}"][data-to-port="${toPort}"]`).addClass('hovered');
        });

        container.on('mouseleave', 'path.connection-hitbox, .formflow-edge-delete', function() {
            let fromId = $(this).attr('data-from');
            let toId = $(this).attr('data-to');
            let fromPort = $(this).attr('data-from-port');
            let toPort = $(this).attr('data-to-port');
            container.find(`.formflow-edge-delete[data-from="${fromId}"][data-to="${toId}"][data-from-port="${fromPort}"][data-to-port="${toPort}"]`).removeClass('visible');
            $(svg).find(`path.connection[data-from="${fromId}"][data-to="${toId}"][data-from-port="${fromPort}"][data-to-port="${toPort}"]`).removeClass('hovered');
        });

        container.on('click', '.formflow-edge-delete, path.connection-hitbox', function(e) {
            let fromId = $(this).attr('data-from');
            let toId = $(this).attr('data-to');
            let fromPort = $(this).attr('data-from-port');
            let toPort = $(this).attr('data-to-port');
            edges = edges.filter(edge => !(edge.from === fromId && edge.to === toId && edge.fromPort === fromPort && edge.toPort === toPort));
            renderGraph();
        });

        // Port Connection Dragging
        container.on('mousedown', '.formflow-port', function(e) {
            draggingPort = $(this).closest('.formflow-node').data('id');
            draggingPortType = $(this).data('port-type');
            tempEdge = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            tempEdge.setAttribute('class', 'connection');
            if (draggingPortType.includes('cond')) {
                tempEdge.style.stroke = '#e68e00';
                tempEdge.style.strokeDasharray = '5,5';
            } else {
                tempEdge.style.stroke = '#007cba';
            }
            svg.appendChild(tempEdge);
            e.stopPropagation();
        });

        $(document).on('mousemove', function(e) {
            if (isPanning) { panX = e.clientX - panStart.x; panY = e.clientY - panStart.y; updateCanvasTransform(); return; }
            let mouseContX = e.clientX - container.offset().left; let mouseContY = e.clientY - container.offset().top + $(window).scrollTop();
            let scaledX = (mouseContX - panX) / currentZoom; let scaledY = (mouseContY - panY) / currentZoom;
            if (draggingNode) {
                let x = scaledX - startPos.x;
                let y = scaledY - startPos.y;
                
                let id = draggingNode.data('id');
                let node = nodes.find(n => n.id === id);
                if (node) {
                    node.x = x;
                    node.y = y;
                    
                    draggingNode.css({
                        left: x + 'px',
                        top: y + 'px'
                    });

                    // Only redraw edges instead of recreating all DOM nodes on every pixel move!
                    scaleWrapper.find('.formflow-edge-delete').remove();
                    svg.innerHTML = '';
                    edges.forEach(edge => {
                        drawEdge(edge.from, edge.to, edge.fromPort, edge.toPort);
                    });
                }
            }

            if (draggingPort && tempEdge) {
                let fromNode = container.find(`.formflow-node[data-id="${draggingPort}"]`);
                let fromLeft = parseFloat(fromNode.css('left')) || 0;
                let fromTop = parseFloat(fromNode.css('top')) || 0;
                let fromWidth = fromNode.outerWidth() || 200;
                let fromHeight = fromNode.outerHeight() || 50;

                let fromPos = { x: 0, y: 0 };
                if (draggingPortType === 'cond-out') { fromPos.x = fromLeft + fromWidth; fromPos.y = fromTop + fromHeight / 2; }
                else if (draggingPortType === 'cond-in') { fromPos.x = fromLeft; fromPos.y = fromTop + fromHeight / 2; }
                else if (draggingPortType === 'priority-out') { fromPos.x = fromLeft + fromWidth / 2; fromPos.y = fromTop + fromHeight; }
                else if (draggingPortType === 'priority-in') { fromPos.x = fromLeft + fromWidth / 2; fromPos.y = fromTop; }
                
                let toX = scaledX;
                let toY = scaledY;

                let cp1x = fromPos.x;
                let cp1y = fromPos.y;
                let offset = 50;
                
                if (draggingPortType === 'cond-out') cp1x += offset;
                else if (draggingPortType === 'cond-in') cp1x -= offset;
                else if (draggingPortType === 'priority-out') cp1y += offset;
                else if (draggingPortType === 'priority-in') cp1y -= offset;

                let cp2x = toX;
                let cp2y = toY;
                if (draggingPortType === 'cond-out' || draggingPortType === 'cond-in') {
                    cp2x = toX - offset * Math.sign(toX - fromPos.x);
                } else {
                    cp2y = toY - offset * Math.sign(toY - fromPos.y);
                }

                let d = `M ${fromPos.x} ${fromPos.y} C ${cp1x} ${cp1y}, ${cp2x} ${cp2y}, ${toX} ${toY}`;
                tempEdge.setAttribute('d', d);
            }
        });

        $(document).on('mouseup', function(e) {
            if (draggingNode) {
                draggingNode = null;
                updateDataInput();
            }
            
            if (draggingPort) {
                let target = $(e.target);
                if (target.hasClass('formflow-port')) {
                    let toId = target.closest('.formflow-node').data('id');
                    let toPortType = target.data('port-type');
                    let isFromIn = draggingPortType.includes('-in');
                    let isToIn = toPortType.includes('-in');

                    if (isFromIn !== isToIn && draggingPort !== toId) {
                        let finalFromId, finalToId, finalFromPort, finalToPort;

                        // Enforce data flow: from = OUT port, to = IN port
                        if (isFromIn) {
                            finalFromId = toId;
                            finalFromPort = toPortType;
                            finalToId = draggingPort;
                            finalToPort = draggingPortType;
                        } else {
                            finalFromId = draggingPort;
                            finalFromPort = draggingPortType;
                            finalToId = toId;
                            finalToPort = toPortType;
                        }

                        if (!edges.find(edge => edge.from === finalFromId && edge.to === finalToId && edge.fromPort === finalFromPort && edge.toPort === finalToPort)) {
                            edges.push({
                                from: finalFromId, 
                                to: finalToId,
                                fromPort: finalFromPort,
                                toPort: finalToPort
                            });
                        }
                    }
                }
                draggingPort = null;
                draggingPortType = null;
                if(tempEdge && tempEdge.parentNode) {
                    tempEdge.parentNode.removeChild(tempEdge);
                }
                tempEdge = null;
                
                scaleWrapper.find('.formflow-edge-delete').remove();
                svg.innerHTML = '';
                edges.forEach(edge => {
                    drawEdge(edge.from, edge.to, edge.fromPort, edge.toPort);
                });
                updateDataInput();
            }
        });

        // Form Name Validation
        $('#post').on('submit', function(e) {
            let title = $('#title').val();
            if (!title || title.trim() === '') {
                e.preventDefault();
                alert('Please enter a name for your FormFlow form before saving.');
                setTimeout(function() {
                    $('#publish').removeClass('button-primary-disabled');
                    $('#publish').siblings('.spinner').removeClass('is-active');
                }, 100);
                $('#title').focus();
                return false;
            }
        });

        // Init
        renderGraph();

	});

})( jQuery );
