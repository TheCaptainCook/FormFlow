<div id="formflow-editor-wrapper">
    <div class="formflow-toolbar">
        <button type="button" class="button button-primary" id="formflow-add-node-btn">
            <span class="dashicons dashicons-plus-alt2"></span> Add Node
        </button>
        <button type="button" class="button" id="formflow-delete-node-btn" style="margin-left: 10px;" disabled>
            <span class="dashicons dashicons-trash"></span> Delete Node
        </button>
    </div>
    
    <!-- Add Node Modal -->
    <div id="formflow-node-modal" class="formflow-modal" style="display: none;">
        <div class="formflow-modal-content">
            <div class="formflow-modal-header">
                <h2>Add Node</h2>
                <span class="formflow-modal-close">&times;</span>
            </div>
            <div class="formflow-modal-body">
                <input type="text" id="formflow-node-search" placeholder="Search nodes..." />
                <div id="formflow-node-wrapper">
                    <!-- Nodes will be injected here via JS -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    
    <div id="formflow-workspace">
        <div id="formflow-canvas-container" style="border: 1px solid #ccc; position: relative; height: 600px; overflow: hidden; background: #f9f9f9; cursor: grab;">
            
            <!-- Zoom Controls -->
            <div id="formflow-zoom-controls" style="position: absolute; bottom: 20px; right: 20px; z-index: 100; display: flex; flex-direction: column; gap: 5px; background: white; padding: 5px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                <button type="button" id="formflow-zoom-in" style="border: none; background: transparent; cursor: pointer; padding: 5px;" title="Zoom In"><span class="dashicons dashicons-plus"></span></button>
                <button type="button" id="formflow-zoom-out" style="border: none; background: transparent; cursor: pointer; padding: 5px;" title="Zoom Out"><span class="dashicons dashicons-minus"></span></button>
                <button type="button" id="formflow-zoom-reset" style="border: none; background: transparent; cursor: pointer; padding: 5px;" title="Reset Canvas"><span class="dashicons dashicons-update"></span></button>
            </div>
            
            <div id="formflow-canvas-scale-wrapper" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; transform-origin: 0 0; transition: transform 0.05s ease-out;">
                <!-- Nodes will be injected here via JS -->
                <svg id="formflow-connections" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; overflow: visible;"></svg>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="formflow_graph_data" name="formflow_graph_data" value="" />
</div>
