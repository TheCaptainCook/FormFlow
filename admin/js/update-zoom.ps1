$file = "c:\Users\Masem\Downloads\0. old\Claude Work\Contact Form Main\FormFlow\admin\js\formflow-node-editor.js"
$content = Get-Content $file -Raw

# 1. Add variables
$content = $content -replace "const graphDataInput = `\$\('#formflow_graph_data'\);", "const graphDataInput = `$('#formflow_graph_data');`r`n        const scaleWrapper = `$('#formflow-canvas-scale-wrapper');`r`n        let currentZoom = 1;`r`n        let panX = 0;`r`n        let panY = 0;`r`n        let isPanning = false;`r`n        let panStart = {x: 0, y: 0};`r`n`r`n        function updateCanvasTransform() { scaleWrapper.css('transform', `'translate(`${panX}px, `${panY}px) scale(`${currentZoom})`'); }`r`n        function setZoom(zoom) { currentZoom = Math.max(0.2, Math.min(zoom, 3)); updateCanvasTransform(); }`r`n        `$('#formflow-zoom-in').on('click', function() { setZoom(currentZoom + 0.1); });`r`n        `$('#formflow-zoom-out').on('click', function() { setZoom(currentZoom - 0.1); });`r`n        `$('#formflow-zoom-reset').on('click', function() { currentZoom = 1; panX = 0; panY = 0; updateCanvasTransform(); });`r`n        container.on('wheel', function(e) { if ($(e.target).closest('.formflow-node-body').length) return; e.preventDefault(); let delta = e.originalEvent.deltaY > 0 ? -0.05 : 0.05; setZoom(currentZoom + delta); });`r`n        container.on('mousedown', function(e) { if (`$(e.target).closest('.formflow-node, .formflow-port, .formflow-edge-delete, #formflow-zoom-controls').length) return; isPanning = true; panStart = { x: e.clientX - panX, y: e.clientY - panY }; container.css('cursor', 'grabbing'); });`r`n        `$(document).on('mouseup', function(e) { if (isPanning) { isPanning = false; container.css('cursor', 'grab'); } });"

# 2. Replace container appends/finds
$content = $content -replace "container.find\('.formflow-node'\)", "scaleWrapper.find('.formflow-node')"
$content = $content -replace "container.find\('.formflow-edge-delete'\)", "scaleWrapper.find('.formflow-edge-delete')"
$content = $content -replace "container.append\(nodeHtml\)", "scaleWrapper.append(nodeHtml)"
$content = $content -replace "container.append\(deleteBtn\)", "scaleWrapper.append(deleteBtn)"

# 3. Node Dragging Mousedown
$searchDragDown = "startPos = \{`r`n                x: e.clientX - draggingNode.position\(\).left,`r`n                y: e.clientY - draggingNode.position\(\).top`r`n            \};"
$replaceDragDown = "startPos = {`r`n                x: ((e.clientX - container.offset().left) - panX) / currentZoom - draggingNode.position().left,`r`n                y: ((e.clientY - container.offset().top + `$(window).scrollTop()) - panY) / currentZoom - draggingNode.position().top`r`n            };`r`n            e.stopPropagation();"
$content = $content -replace [regex]::Escape($searchDragDown), $replaceDragDown

# 4. Node Dragging Mousemove
$searchDragMove = "        `$\(document\).on\('mousemove', function\(e\) \{`r`n            if \(draggingNode\) \{"
$replaceDragMove = "        `$(document).on('mousemove', function(e) {`r`n            if (isPanning) { panX = e.clientX - panStart.x; panY = e.clientY - panStart.y; updateCanvasTransform(); return; }`r`n            let mouseContX = e.clientX - container.offset().left; let mouseContY = e.clientY - container.offset().top + `$(window).scrollTop();`r`n            let scaledX = (mouseContX - panX) / currentZoom; let scaledY = (mouseContY - panY) / currentZoom;`r`n            if (draggingNode) {"
$content = $content -replace $searchDragMove, $replaceDragMove

$searchDragMath = "let x = e.clientX - startPos.x;`r`n                let y = e.clientY - startPos.y;`r`n                `r`n                // Keep inside bounds`r`n                let maxX = container.innerWidth\(\) - draggingNode.outerWidth\(\);`r`n                let maxY = container.innerHeight\(\) - draggingNode.outerHeight\(\);`r`n                x = Math.max\(0, Math.min\(x, maxX\)\);`r`n                y = Math.max\(0, Math.min\(y, maxY\)\);"
$replaceDragMath = "let x = scaledX - startPos.x;`r`n                let y = scaledY - startPos.y;"
$content = $content -replace $searchDragMath, $replaceDragMath

# 5. Port Dragging Mousemove (toX, toY)
$searchPortTo = "let toX = e.clientX - container.offset\(\).left;`r`n                let toY = e.clientY - container.offset\(\).top \+ `$\(window\).scrollTop\(\);"
$replacePortTo = "let toX = scaledX;`r`n                let toY = scaledY;"
$content = $content -replace $searchPortTo, $replacePortTo

[IO.File]::WriteAllText($file, $content)
Write-Output "Done"
