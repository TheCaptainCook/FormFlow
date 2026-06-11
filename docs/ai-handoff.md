# AI Handoff Document: FormFlow

## Current State
The FormFlow plugin has been modernized with a dynamic, plug-and-play node architecture and an interactive builder interface:
1. **Dynamic Node Registry**: Node discovery is class-based. Adding a node requires creating `includes/nodes/input/class-node-[name].php` extending `FormFlow_Node`. The system automatically registers it and exposes its `get_js_config()` configuration to JS. This configuration dictates the dynamic settings the node requires (e.g., `placeholder`, `min`/`max` values, `options`), which the JS engine automatically parses and renders as a custom settings form in the UI.
2. **Category-Grouped UI Modal**: The "Add Node" modal displays fields grouped by functional category (Input, Validation, Logic, etc.) mirroring the `Tiers.md` definitions. They have sticky headers with relevant dashicons that stack as the user scrolls. Star badges denote premium status, the meta footer lists the specific tier (Free, Pro, Business, Lifetime), and hovering shows a tooltip with the required tier. The layout is a strict `repeat(3, 1fr)` CSS grid.
3. **Frontend Tier Enforcement**: The JavaScript builder evaluates the `is_accessible` parameter exported from PHP (which runs Freemius SDK `is_plan` checks). If false, the card is greyed out (`.locked` class) and attempting to add it triggers an upgrade `alert()` blocking insertion.
4. **Canvas Snapping & Routing**: The visual editor uses a 4-directional port architecture. Top and bottom ports control the Priority of the field in the forms. Left and right ports control the Conditional Logic of the forms input. Edges dynamically calculate bezier curves based on the connected port types to prevent tangling. The JSON edge graph explicitly records `fromPort` and `toPort`. Connected edges are drawn using raw SVG paths (`#formflow-connections`).
5. **Tailwind-Style Scoped Live Preview**: The live preview panel dynamically displays the state of the form using modern styling and entry/exit keyframe animations. To avoid breaking the WordPress Admin panel dashboard, styles are written in scoped vanilla CSS instead of importing a global Tailwind CDN.
6. **Spam & Honeypot**: Basic honeypot and keyword checkers are active in PHP.
7. **Frontend Renderer**: Shortcode `[formflow id="X"]` parses the JSON graph into HTML and submits via AJAX.
12. **Expansive Roadmap**: The node blueprint in `Tiers.md` defines a massive 262-node architecture across 20 categories, explicitly designed to bias users toward a Lifetime tier purchase.

## Rules & Constraints for Future Development

> [!IMPORTANT]
> **Plug-and-Play Modular Architecture**:
> Keep all logic in small, modular pieces. Whenever required, create folders to keep things organized. Any new functionality added must be plug-and-play and automatically discoverable by the registry (like the `FormFlow_Node_Registry`). Avoid hard-coded manual connections.

> [!WARNING]
> **No Global Styling Frameworks in WP Admin**:
> Enqueuing standard Tailwind CSS or Bootstrap globally in the WP Admin dashboard will pollute standard WordPress elements. Write scoped CSS/inline styles in `admin/css/formflow-admin.css` or scoped preview wrapper divs.

> [!IMPORTANT]
> **Adding New Nodes**:
> Simply drop a new file `class-node-*.php` into `includes/nodes/input/` extending `FormFlow_Node`. The registry will load, instantiate, and pass it to the frontend automatically.

> [!TIP]
> **Drag-and-Drop Coordinate System**:
> Coordinate calculation in `admin/js/formflow-node-editor.js` operates relative to the canvas offset wrapper. When altering layout or zooming, ensure client-to-offset conversions use relative maths.

## Future Development Paths (For AI)

### 1. Evaluate Edge Logic on Frontend
- Currently, the frontend shortcode renderer prints active input fields sequentially.
- Integrate the graph evaluation engine on the frontend (`public/js/formflow-public.js`) to parse `edges` and handle conditional routing (e.g., hiding field B until condition A is met).

### 2. Submission Storage & Dashboard
- Build a dedicated admin dashboard page to browse, search, and export local form submissions.

### 3. Connect Premium SDK Upsells
- Connect the tier gating mechanism logic in `abstract-class-formflow-node.php` to a live Freemius integration/upgrade path checkout page.

### 4. Build Out 262 Nodes Roadmap
- Incrementally implement the massive 262-node backlog defined in `Tiers.md` across the 20 new functional categories. Ensure each new node accurately inherits the tiering restrictions.
