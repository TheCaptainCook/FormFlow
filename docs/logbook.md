# FormFlow Changelog & Logbook

This logbook records the major development milestones, features, bug fixes, and modifications implemented in the FormFlow plugin.

---

## 🕒 [2026-06-11 18:12:00] Refactor: Nodes Are Now Square Boxes
- **Canvas Node Appearance**: Nodes are now clean, fixed `120×120px` square boxes showing only the node name label. All inline field rendering (labels, inputs, checkboxes, textareas) has been stripped from the canvas.
- **Config Stays in PHP**: Field definitions remain in each node's PHP `get_js_config()` and are stored in JS state for saving — they just don't render inside the canvas box.
- **CSS Cleanup**: Removed old `.formflow-node-header`, `.formflow-node-body`, `.formflow-node-controls`, `.formflow-dynamic-field` styles. Added `.formflow-node-label` for the centered node name.
- **JS Cleanup**: Removed `fieldsHtml` builder, `ResizeObserver`, minimize/expand toggle, and `widthStyle` tracking from `renderGraph()`.

## 🕒 [2026-06-11 17:55:00] Architecture: Input Node 4-Port Update
- **Full Port Implementation**: Updated all 22 Input/Field node PHP files to expose all 4 connection points. Previously they only had `priority-in` (top) + `priority-out` (bottom). Now they also have `cond-in` (left) + `cond-out` (right) to allow Validation, Logic, and other nodes to connect and apply properties to any field.
- **Tiers.md Updated**: Rewrote the Section 2 table to include the Functionality column and documented the 4-port architecture spec.

## 🕒 [2026-06-09 20:46:00] Bug Fix: Canvas Edge Flow Direction
- **Data Flow Enforcement**: Fixed a bug where dragging a connection from a target node (bottom) to a source node (top) backwards would result in the underlying data structure treating the bottom node as the origin of the data. The engine now automatically detects whether a port is an IN or OUT port and intelligently flips the connection direction to enforce strict `OUT -> IN` logical flow, regardless of which direction the user dragged their mouse.
- **Port Matching**: Prevented invalid connections such as linking two INPUT ports or two OUTPUT ports together.

## 🕒 [2026-06-09 20:41:00] Validation: Form Name Requirement
- **Prevent Empty Forms**: Added an interception hook to the WordPress post submission event. If a user attempts to Save or Publish a FormFlow without providing a title (Form Name), the submission is blocked, a helpful alert is displayed, and their cursor is automatically focused on the title field.

## 🕒 [2026-06-09 20:34:00] UI/UX Improvement: Node Selection & Deletion
- **Node Highlighting**: Added a visual selection state. Clicking on any node now highlights it with a blue glowing border and elevates it to visually indicate that it is currently active. Clicking the canvas background gracefully deselects it.
- **Global Delete Action**: Replaced the old embedded 'X' delete buttons with a new "Delete Node" action button located dynamically in the main toolbar, right next to the "Add Node" button. This button is intelligently enabled/disabled based on whether you have an active node selected.

## 🕒 [2026-06-09 20:20:00] Bug Fix: Canvas Connection Lines
- **Zoom Coordinate Math**: Fixed a critical bug where connection lines (edges) would detach or break when zooming the canvas. The engine was using jQuery's `.position()` method, which calculates dynamic offsets that break under CSS `transform: scale()`. Rewrote the drawing engine to pull raw, untransformed coordinate data directly from the DOM so the bezier curves stay perfectly glued to the ports at any zoom level.

## 🕒 [2026-06-09 20:13:00] Bug Fix: Canvas Hard Edges
- **Infinite Boundary Fix**: Found and removed old code that was artificially clamping node drag coordinates to the `container.innerWidth()` and `innerHeight()`. This clamping was creating an invisible "hard edge" wall when you zoomed out or panned around. The canvas is now a truly infinite playground.

## 🕒 [2026-06-09 20:06:00] Bug Fix: Canvas Connection Ports
- **Array Parsing**: Fixed an issue where the canvas was failing to render the node connection ports. The frontend JavaScript was still looking for the old legacy object format (`p.name === 'priority_in'`) instead of the new clean string arrays (`priority-in`) we established during the architecture rewrite.

## 🕒 [2026-06-09 20:00:00] Architecture Update: Input Node Ports
- **Field Port Assignment**: Batch-updated all 21 Input/Field nodes (e.g., text, email, select, etc.) defined in `tiers.md` to exclusively use the top (`priority-in`) and bottom (`priority-out`) connection points, precisely mapping them into the new visual priority hierarchy.

## 🕒 [2026-06-09 19:53:00] Feature Addition: Infinite Canvas Zoom & Pan
- **Slick UI Controls**: Built a floating 3-button control panel in the bottom corner of the canvas using slick dashicons (Zoom In, Zoom Out, Reset). 
- **Mouse Wheel Zoom**: Implemented fluid zoom scaling attached directly to the mouse wheel for quick navigation.
- **Background Panning**: Implemented "infinite canvas" mechanics where clicking and dragging anywhere on the empty canvas smoothly pans the workspace around. 
- **Mathematical Rewiring**: Recalculated the entire node-dragging and bezier-edge-drawing JavaScript coordinate math to automatically compensate for dynamic scaling and panning.

## 🕒 [2026-06-09 19:48:00] Feature Addition: Custom Shortcode IDs
- **Shortcode Customization**: Built a custom ID override system. The "Form Embed Code" meta box now includes a toggle to set a custom string-based ID (e.g. `[formflow id="contact-1"]`). It validates uniqueness on save and smoothly overrides the global WordPress Post ID in the frontend parser.

## 🕒 [2026-06-09 19:48:00] UI Tweaks: Default Canvas State
- **Empty Canvas**: Removed the default "Submit" node that was automatically injected into every new form. The canvas and live preview now start completely blank.

## 🕒 [2026-06-09 19:45:00] UI Tweaks: Live Preview Relocation
- **Layout Change**: Moved the Live Preview from inside the node editor canvas layout into a native WordPress meta box in the right sidebar (`side` context). The node canvas now utilizes the full width of the main editor column.

## 🕒 [2026-06-09 19:42:00] UI Tweaks: Node Header
- **Removed Node Controls**: Removed the minimize/maximize and delete buttons from the node headers on the canvas, simplifying the node blocks.

## 🕒 [2026-06-09 19:40:00] UI Bug Fix: Sidebar Menu
- **Sidebar Clutter Resolved**: Removed the loop in `class-formflow-admin.php` that dynamically injected every individual created form into the WordPress admin sidebar as a sub-menu item. Forms are now only accessible via the standard WP post table, preventing sidebar overflow.

## 🕒 [2026-06-09 19:30:00] 4-Port Functionality Re-assignment
- **Architecture Shift**: Redefined the 4-port connection points across the node engine. Left and right points will now strictly control *Conditional Logic* (data entry/exit), while top and bottom points will strictly control the *Priority* of the fields in the form.
- **Node Ports Cleared**: Temporarily removed all predefined `inputs` and `outputs` configuration points from all existing nodes in preparation for the new port-assignment phase.

## 🕒 [2026-06-08 16:26:00] Trigger Nodes Data Flow Update
- **Data Ports Implementation**: Updated all 8 Trigger/Entry nodes to utilize the 4-port directional routing architecture. Trigger nodes now explicitly feature both a left `data_in` input port and a right `data_out` output port to support data flow into and out of the triggers, replacing the legacy `event` trigger output.

## 🕒 [2026-06-08 15:58:00] 4-Port Directional Routing Architecture
- **Multi-Flow Ports**: Completely overhauled the visual node editor's port logic, transitioning from a linear 2-port system to an advanced 4-directional system. Nodes can now independently route Data flows (Left `data_in` / Right `data_out`) and Conditional Logic flows (Bottom `cond_in` / Top `cond_out`).
- **Dynamic Port Injection**: Updated the JavaScript frontend to dynamically generate only the specific ports requested by the PHP node's internal configuration array, safely hiding unnecessary ports based on the node's function.
- **Smart Bezier Routing**: Implemented an intelligent SVG routing engine that calculates horizontal bezier curves for data connections (solid blue) and vertical bezier curves for conditional connections (dashed orange) to ensure wires remain visually organized.
- **Graph State Tracking**: Upgraded the JSON serialization engine to explicitly record `fromPort` and `toPort` identifiers within the `edges` payload for complex backend evaluation.

## 🕒 [2026-06-08 15:18:00] Tiers & Architecture Blueprint Expansion
- **262 Node Roadmap**: Massively expanded `Tiers.md` to define a staggering 262 nodes across 20 distinct functional categories (including UI/UX, Third-Party Integrations, Math, File Processing, HTTP/API, and more).
- **Aggressive Upsell Strategy**: Re-engineered the pricing philosophy to heavily bias and upsell the Lifetime tier ($699.99), intentionally restricting the Free, Pro, and Business tiers to drive conversions. The architecture is now strictly oriented around this new god-mode model.

## 🕒 [2026-06-06 22:46:00] Spam Protection Nodes Integration
- **10 New Security Nodes**: Built and integrated all 10 Spam Protection nodes defined in the `Tiers.md` specification. These were placed inside the `spam/` directory.
- **Auto-Discovery Engine Expansion**: Safely added the `spam` directory to the central Node Registry array, instantly allowing the 10 new nodes to register and inherit their Freemius visual tiering locks inside the UI.
- **Node List**: `Honeypot`, `Time Trap` (Free); `Rate Limiter` (Pro); `Google reCAPTCHA`, `Cloudflare Turnstile` (Business); `hCaptcha`, `Blocklist Email`, `Blocklist IP`, `Blocklist Keyword`, `Browser Fingerprint` (Lifetime).

## 🕒 [2026-06-06 22:39:00] Trigger Registry Bugfix
- **Class Naming Resolution**: Fixed an issue where the 8 Trigger nodes were failing to appear in the Add Node popup. The central auto-discovery engine expects class names to perfectly match the hyphenated filename structure (e.g. `class-node-on-page-load.php` strictly maps to `FormFlow_Node_On_Page_Load`). The trigger nodes were initially generated with camelCase class names (`FormFlow_Node_OnPageLoad`), causing them to silently fail instantiation. The trigger classes have been systematically renamed, and they are now successfully auto-discovering into the UI again!

## 🕒 [2026-06-06 22:30:00] Validation Nodes Integration
- **17 New Logic Nodes**: Fully implemented all 17 Validation nodes defined in the `Tiers.md` specification. These were placed inside the `validation/` directory and were instantly picked up and parsed by the advanced Node Registry auto-discovery engine.
- **Tier Distribution**: Free tier includes `Required`, `Valid Email`, `Min Length`, `Max Length`. Pro tier includes `Regex`, `Min Value`, `Max Value`, `Match`. Business tier includes `Unique Database`, `File Type`, `File Size`. Lifetime tier includes `Date Range`, `Age`, `Credit Card`, `Postal Code`, `VAT`, and `IBAN`. All tiering logic gracefully passes through to the frontend via the `is_accessible()` interface.

## 🕒 [2026-06-06 22:24:00] Trigger Nodes Integration
- **8 New Entry Points**: Fully implemented and registered all 8 Trigger/Entry nodes defined in the `Tiers.md` specification. This includes `onPageLoad`, `onButtonClick`, `onFormSubmit` (Free); `onFieldChange` (Pro); `onTimer` (Business); and `onScroll`, `onWebhookReceive`, `onSchedule` (Lifetime).
- **Freemius Licensing Security**: Integrated the tier-locking rules defined in `tiers_logic.md`. The nodes are now globally registered in the PHP backend, allowing the frontend React/jQuery canvas to perform auto-discovery, properly display them in the UI with their respective configurations, and accurately apply visual lock icons based on the user's active Freemius license via the `is_accessible()` inheritance chain.

## 🕒 [2026-06-06 22:09:00] Frontend Engine Parity
- **Shortcode Rendering Overhaul**: The `[formflow]` shortcode rendering engine in `formflow-public-display.php` was completely rewritten to achieve 1:1 parity with the backend Live Preview. It now natively supports Kahn's Algorithm for Topological Sorting, automatically strips out disconnected nodes, and flawlessly renders all 22 dynamic node types (including selects, radio buttons, sliders, and color pickers) with identical CSS styles and entrance animations.

## 🕒 [2026-06-06 21:57:00] Wiring Engine Optimization
- **Wire Drop Performance Fix**: Fixed the exact same layout thrashing bug that previously affected node dragging! When you dropped a wire (either successfully connecting it or missing), the engine was unnecessarily destroying and rebuilding the entire node DOM. This caused the `ResizeObserver` to miscalculate phantom widths and suddenly expand the nodes. Dropping a wire now uses the hyper-fast targeted SVG edge repainter, completely eliminating the expansion bug and making wire connections buttery smooth!

## 🕒 [2026-06-06 21:51:00] Canvas Spatial Boundaries
- **Strict Boundary Enforcement**: The node editor canvas now perfectly enforces all four spatial boundaries. Previously, only the top and left edges acted as walls; dragging a node to the right or bottom would allow it to clip out of bounds and become lost forever. The dragging engine now actively computes the live geometry of the canvas container minus the node's dimensions and mathematically hard-clamps the node's coordinates so it can never be pushed off the edge!

## 🕒 [2026-06-06 21:48:00] Intuitive Graph Deletion
- **Hitbox Deletion Support**: Previously, to delete a connection line, you had to carefully click the tiny "X" button that spawned in the exact center of the line. I have bound the click event listener directly to the invisible 15px interaction hitbox that wraps the entire line. Now, when a line glows red, clicking *anywhere* on the line itself will instantly sever the connection.

## 🕒 [2026-06-06 21:46:00] Canvas UI Enhancements
- **Port Scaling & Hitboxes**: Significantly increased the physical dimensions of the node connection ports. They have been scaled up by ~60% and given a crisp white border with a drop shadow to act as clear visual anchors.
- **Magnetic Port Interactions**: Hovering over a port now triggers a smooth, spring-bounce CSS animation that scales the port up by an additional 1.4x and flashes bright red, providing extremely satisfying and unambiguous targeting feedback.

## 🕒 [2026-06-06 21:42:00] Dynamic Node Pruning
- **Disconnected Node Exclusion**: Updated the Live Preview renderer to aggressively scan the edge connections table. Any node that is dragged onto the canvas but left completely disconnected (missing both incoming and outgoing wires) will now be treated as a draft/temporary node and explicitly excluded from the live preview until you successfully wire it into the main graph.

## 🕒 [2026-06-06 21:35:00] Graph Traversal Architecture
- **Topological Node Sorting**: Rewrote the Live Preview ordering engine to prioritize explicit graph linkages over spatial coordinates. The engine now uses Kahn's Algorithm for Topological Sorting. If you explicitly connect Node A to Node B with an SVG edge, Node A is mathematically guaranteed to render above Node B in the live form, regardless of their physical placement on the screen.
- **Deterministic Edge Cases**: For parallel logic branches or disconnected components, Kahn's algorithm dynamically falls back to utilizing spatial Y-coordinates as a secondary sorting metric to ensure predictable, top-to-bottom rendering. The Submit Button is now permanently forced to the tail of the array.

## 🕒 [2026-06-06 21:30:00] Event Architecture Consolidation
- **Universal Preview Triggers**: Consolidated the graph update event broadcasting mechanism in `formflow-node-editor.js`. The `formflowGraphUpdated` event is now natively bundled into the core `updateDataInput()` state saver. As a result, the Live Preview engine will now instantly re-render and re-sort whenever you drop a dragged node, modify a connection, or adjust a setting, ensuring perfectly synchronized spatial visual sorting at all times.

## 🕒 [2026-06-06 21:22:00] Preview Rendering Logic
- **Spatial Node Priority**: Fixed an issue where the Live Preview rendered input fields out of order based on the background array insertion history. The preview engine now features a spatial sorting algorithm that reads the `Y` (vertical) coordinates of every node on the canvas and forces them to render strictly from top to bottom. You can now visually reorder your live form instantly just by dragging a node higher or lower on the screen!

## 🕒 [2026-06-06 21:13:00] Preview Engine Hotfix
- **Live Preview Crash Resolution**: Fixed a critical `TypeError` in `formflow-preview.js`. The live preview engine was previously assuming that every node on the canvas possessed a `label` property to build dynamic placeholder text. The newly introduced `submitButton` node does not have a label, causing an undefined property exception that crashed the entire preview renderer. A fallback string coercion was added to prevent the crash, and the engine now successfully strips top-level labels from rendering above action buttons.

## 🕒 [2026-06-06 21:09:00] Editor Engine Optimization
- **Drag Performance Overhaul**: Fixed a critical memory and rendering bug where dragging a node triggered a full DOM destruction and recreation 60 times a second. This layout thrashing was causing the `ResizeObserver` to detect phantom maximum widths and artificially "expand" nodes during movement. The engine now uses targeted hardware-accelerated CSS translation and selective SVG edge repainting during drags, resulting in a perfectly smooth, bug-free dragging experience.

## 🕒 [2026-06-06 21:05:00] UI Compactness & State Injection
- **Compact UI Canvas**: Reduced the padding, margins, and font sizes within the `.formflow-node-body` and `.dynamic-node-input` elements. Configuration fields inside deployed nodes are now much more compact, allowing more fields to be visible without stretching the node excessively.
- **Dynamic State Blueprinting**: Fixed a critical bug where default pre-deployed nodes (like the Submit Button) spawned without their internal configuration blueprints, causing their UI fields to vanish. `formflow-node-editor.js` now natively intercepts any node missing a `config` payload and dynamically injects the correct UI blueprint from the registry before rendering.

## 🕒 [2026-06-06 20:48:00] Graph Connection Controls
- **Interactive Edges**: The SVG connection lines between nodes are now fully interactive. Because standard 2px Bezier curves are notoriously hard to hover over, a 15px invisible "hitbox" path is now drawn directly over every connection line to catch the user's cursor.
- **Edge Deletion UI**: Hovering over any connection line will now highlight it in red and spawn a floating delete ("✖") button perfectly aligned to the center of the bezier curve. Clicking this button severs the connection and instantly reroutes the graph data.

## 🕒 [2026-06-06 20:44:00] Node Card Data Expansion
- **Node Descriptions**: Extended the core architecture (`abstract-class-formflow-node.php`) to require a `get_description()` method. Injected concise, human-readable descriptions into all 22 active PHP node classes.
- **Modal Card Redesign**: Redesigned the HTML structure of the node cards in the Add Node modal. The tier label (Free/Pro/Business/Lifetime) has been relocated from the bottom to the top-right corner of the card alongside a premium star icon. The newly added node descriptions are now rendered clearly beneath the node title.

## 🕒 [2026-06-06 20:41:00] UI Node Modal Priority Sorting
- **Smart Sorting**: Refactored the `renderNodeGrid()` function in `formflow-node-editor.js`. Nodes inside the "Add Node" modal are now dynamically sorted so that unlocked/accessible nodes always surface to the top of their respective category sections, while locked/premium nodes are pushed to the bottom. They are further sorted alphabetically within those two groups.

## 🕒 [2026-06-06 20:23:00] Dynamic Submit Node Migration
- **Core Node Generation**: Created a new core action node class `class-node-submit-button.php`. All new forms now initialize with this `submitButton` node by default.
- **Node Protection**: Updated `formflow-node-editor.js` to hide the delete controls for `submitButton` nodes and intercept any programmatic deletion events, ensuring every form always maintains a submit mechanism.
- **Live Preview Refactor**: Stripped out the hard-coded "Submit Form" HTML block from the end of the `formflow-preview.js` engine. The engine now dynamically renders the submit button natively from the node graph, allowing users to visually customize its label text and color codes directly from the canvas settings.

## 🕒 [2026-06-06 20:19:00] Flexible Node Sizing
- **Manual Node Resizing**: Replaced the hard-coded 150px node width constraint with a fluid CSS layout (`min-width: 200px`, `width: auto`, `resize: horizontal`). Users can now manually drag the bottom-right corner of any node to resize it horizontally to fit long placeholder text or labels. 
- **Real-time Edge Routing**: Implemented a native Javascript `ResizeObserver` on the editor canvas. As the user drags to resize a node, the attached SVG connection lines instantly redraw and follow the expanding edges. The custom width state is continuously saved to the JSON graph data.

## 🕒 [2026-06-06 20:15:00] UI Consistency Polish
- **Node Control Icons**: Replaced the native Unicode text characters (`＋`/`－`/`✖`) used for the node minimize and delete actions with WordPress native Dashicons (`dashicons-plus-alt2`, `dashicons-minus`, `dashicons-dismiss`). This resolves rendering inconsistencies where the buttons appeared radically different in size depending on the operating system's font scaling.

## 🕒 [2026-06-06 20:12:00] Editor Canvas Enhancements
- **Node Minimize/Maximize Controls**: Added a size toggle button (`＋`/`－`) next to the delete button in every node's header. Users can now collapse node bodies to save canvas real estate. The node's `minimized` state is saved directly into the JSON graph, and SVG connection lines instantly recalculate their vertical anchor positions when a node's size changes.

## 🕒 [2026-06-06 20:10:00] Live Preview Hotfix
- **JS Syntax Resolution**: Fixed a syntax crash in `formflow-preview.js` caused by a lingering closing brace `}` left behind during the removal of the spam logic. The Live Preview engine is now fully functional again.

## 🕒 [2026-06-06 19:52:00] Editor Polish & Cleanup
- **Spam UI Removed**: Completely stripped out the static "Spam Protection Status" module from the Live Preview column in `formflow-editor-display.php` and its associated JavaScript logic to clean up the editor interface.
- **Dynamic Checkbox Text**: Added a new `checkboxText` config parameter to the `CheckboxField` PHP class, allowing users to freely edit the text that sits beside the checkbox. Updated the Live Preview JS to render this dynamically.
- **Modal Width Expanded**: Increased the `max-width` of the "Add Node" modal from `800px` to `1200px` in CSS so that the new 3-column layout has sufficient breathing room and isn't squished.

## 🕒 [2026-06-06 19:35:00] Editor Canvas Quality of Life Fixes
- **Removed Default Dummy Nodes**: Modified `admin/class-formflow-admin.php` so that newly created forms initialize with a completely blank canvas (`nodes: [], edges: []`) instead of pre-populating with the tutorial nodes.
- **Fixed SVG Edge Drawing Offsets**: Refactored the path calculation logic in `admin/js/formflow-node-editor.js`. The calculations now use `.outerWidth()` and `.outerHeight()` rather than `.width()` and `.height()`. This fixes the visual bug where connecting lines were detaching several pixels away from the node edges due to uncalculated border and padding dimensions.

## 🕒 [2026-06-06 19:25:00] UI Layout & Access Control Enforcement
- **Tier Access Enforcement**: Implemented strict frontend validation for node insertion. `formflow-node-editor.js` now reads the `is_accessible` parameter generated by the Freemius SDK logic in PHP. Inaccessible premium nodes are visually greyed out (`.locked`) and trigger an upgrade alert when clicked, preventing unauthorized usage.
- **Strict 3-Column Modal**: Enforced a strict 3-column CSS Grid layout (`grid-template-columns: repeat(3, 1fr);`) in the "Add Node" modal, replacing the previous fluid `auto-fill` rule for better uniformity.
- **Removed Legacy Fallback**: Stripped out the legacy fallback "Label" HTML so nodes render exclusively with their precise, dynamic configuration fields.

## 🕒 [2026-06-06 19:15:00] Dynamic Node Configuration Fields
- **Dynamic Field Registration**: Updated all 21 PHP node classes to inject unique, context-specific configuration schemas via `get_js_config()`. E.g., `selectField` requires `options`, `numberField` dictates `min`/`max`.
- **Node Editor JSON Graph**: Restructured the JS `nodes` data model in `formflow-node-editor.js` to store field data in `node.fieldValues`.
- **Dynamic HTML Generation**: The visual builder now loops through `node.config.config.fields` to dynamically generate custom control forms (text inputs, checkboxes, textareas, numbers) based on the node selected, rather than a singular static "Label" input.
- **Intelligent Live Preview**: Rewrote the Live Preview engine (`formflow-preview.js`) to deeply integrate with the new `node.fieldValues` array. Previews now respect `showLabel` visibility, use custom `placeholder` text, enforce HTML5 `required` flags, and render parsed `options` arrays into live select dropdowns and radio groups.

## 🕒 [2026-06-06 18:19:00] Add Node Modal Category Grouping
- **Category Grouping**: Overhauled the "Add Node" modal to group cards by their functional Category (e.g. "Input / Field Nodes", "Validation Nodes") mirroring `Tiers.md`, replacing the previous Pricing Tier grouping.
- **Category Dashicons**: Added corresponding visual Dashicons to the sticky headers of each category section.
- **Tier Label Pills**: Moved pricing tier badges to the card footer, implementing custom color-coded pill tags (`.tier-label-free`, `.tier-label-pro`, etc.) in `formflow-admin.css`.
- **Documentation**: Updated `logbook.md` and `ai-handoff.md` to document the category grouping logic.

## 🕒 [2026-06-06 18:05:00] Architecture & Documentation Overhaul
- **Initialized Logbook**: Created this `logbook.md` file to maintain chronological progress records.
- **README Redesign**: Revamped `README.md` with rich formatting, explicit feature sets, and a getting-started guide for creating new nodes.
- **Architecture Flow**: Updated `architecture.md` to detail the `FormFlow_Node_Registry` loading sequence and the JSON graph lifecycle.
- **AI Constraints**: Updated `ai-handoff.md` warning against enqueuing global styling frameworks (like Tailwind CDN) to preserve standard WordPress Admin UI integrity.

## 🕒 [2026-06-06 12:30:00] Real-time Preview & UI Polish
- **Instant Synchronization**: Linked the node canvas to the live preview panel for real-time field rendering.
- **Scroll Bounds & Overflow**: Added scroll-snapping and boundary boxes to prevent elements from spilling outside the preview frame.
- **Micro-Animations**: Implemented custom CSS transition fades and staggered keyframe animations for inserted fields.
- **Snapping Offset Fix**: Corrected a visual drag-and-drop coordinate bug by shifting client maths to be relative to the canvas offset.

## 🕒 [2026-06-06 11:45:00] Core Plug-and-Play Architecture
- **Dynamic Node Registry System**: Created `FormFlow_Node_Registry` to scan, discover, and dynamically register node classes matching `class-node-*.php`.
- **Abstract Node Class**: Implemented `FormFlow_Node` interface enforcing common properties (ID, name, category, pricing tier, JS configs, access rules).
- **21 Dynamic Nodes**: Replaced legacy static buttons with 21 robust input/logic nodes (e.g., `textField`, `ratingStars`, `signaturePad`, `addressAutocomplete`).
- **Premium Tier Logic**: Enforced Freemius gating logic inside each node class based on its assigned tier level.
- **JS Localization**: Serialized registered nodes and injected them safely into the frontend via the `formflowEditorData` payload.
