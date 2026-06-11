# 🚀 FormFlow

FormFlow is a visual, node-based contact form builder for WordPress. It lets you visually connect inputs, validation rules, spam protection, and delivery actions using a drag-and-drop node canvas.

No repetitive coding, no heavy block-editor bloat—just clean, logical form routing.

---

## ✨ Features

- **Visual Node Canvas**: Drag, drop, and connect input fields, validation rules, and actions.
- **Dynamic Plug-and-Play Nodes**: Extensible OOP structure in PHP. Drop a new node class file into the directory, and it instantly loads in the UI.
- **Modern Tier-Categorized Modal**: Beautifully organized add-node catalog grouped by tier (Free, Pro, Business, Lifetime) featuring:
  - Sticky stackable category headers
  - Premium star indicators and tier tooltips
  - Dynamic real-time node search filtering
- **Fluid Live Preview**: Real-time form rendering panel with smooth entrance transitions, container boundary checks, and modern styling.
- **Spam Engine Built-in**: Out-of-the-box honeypot, time-trap, and keyword validation.
- **Shortcode & AJAX Integration**: Render forms anywhere using `[formflow id="X"]` with background submit handling.

---

## 🛠️ Folder Structure

```
FormFlow/
├── admin/               # Editor dashboard, styles, and builder scripts
├── public/              # Shortcode parser and frontend display logic
├── includes/            # core loader and activator hooks
│   ├── class-formflow-node-registry.php   # Dynamic node class autoloader
│   └── nodes/           # Node base definition & modular field types
└── docs/                # Architecture, Handoff manuals, and Tier mappings
```

---

## 🏗️ Getting Started

### Creating a New Node (Plug & Play)

To add a new input field, validation constraint, or integration:

1. Create a new file under `includes/nodes/input/class-node-your-field.php`.
2. Define a class that extends `FormFlow_Node`:
   ```php
   class FormFlow_Node_Your_Field extends FormFlow_Node {
       public function get_id() { return 'yourField'; }
       public function get_name() { return 'Your Field'; }
       public function get_category() { return 'input'; }
       public function get_tier() { return 'free'; } // 'free', 'pro', 'business', 'lifetime'
       public function get_js_config() {
           return array(
               'type' => 'text',
               'placeholder' => 'Enter value...',
           );
       }
   }
   ```
3. That's it! The registry automatically registers the class, and the JS builder renders it as an option in the UI modal.

---

## 📄 Documentation

For detailed guides, please refer to:
- 🗺️ [Architecture Reference](file:///docs/architecture.md)
- 🤖 [AI Handoff Guidelines](file:///docs/ai-handoff.md)
- 💎 [Pricing & Tier System Matrix](file:///docs/Tiers.md)
- 🪵 [Change Log & Logbook](file:///docs/logbook.md)

