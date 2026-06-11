# FormFlow Architecture

## Overview

FormFlow is a modular WordPress plugin built to provide a visual, node-based contact form builder. The core philosophy separates the visual graph representation (stored as JSON) from the backend parsing and rendering logic.

All form nodes are designed to be "plug-and-play" modules, loaded dynamically via a registry system.

## Directory Structure

- `admin/`: Contains the admin UI, node editor JS, and live preview logic.
  - `css/`: Admin-specific styles, including modal layouts, sticky headers, and animations.
  - `js/`: Node editor canvas logic (`formflow-node-editor.js`) and Live Preview rendering engine (`formflow-preview.js`).
- `public/`: Contains the frontend shortcode renderer and AJAX submission handler.
- `includes/`: Core classes for plugin activation, deactivation, and the central `FormFlow` loader.
  - `class-formflow-node-registry.php`: Automatically discovers and registers nodes from the `nodes/input/` directory.
  - `nodes/`: Contains node definitions.
    - `abstract-class-formflow-node.php`: The abstract base class representing any field/logic node.
    - `input/`: Dynamic node classes (e.g., `class-node-text-field.php`, `class-node-email-field.php`, etc. — 21 types in total).
- `includes/modules/spam-protection/`: Contains the `FormFlow_Spam_Engine` which handles honeypot and heuristic spam checks.

## Node Registry & Plug-and-Play System

1. **Discovery**: `FormFlow_Node_Registry` scans `includes/nodes/input/class-node-*.php` using globbing.
2. **Registration**: It parses file names to class names (e.g., `class-node-text-field.php` -> `FormFlow_Node_Text_Field`), instantiates them, and registers them.
3. **Serialization**: Registered nodes serialize their attributes (ID, Name, Category, Tier, JS configuration, and Access Rules) using `to_array()`.
4. **Localization**: The registry arrays are localized via `wp_localize_script()` in the WordPress admin enqueue phase under the JS object `formflowEditorData`.

## Data Flow

1. **Building (Admin)**: The user opens the Add Node modal. The modal queries localized node classes, displaying them in a homogeneous, categorized list grouped by subscription tier (Free, Pro, Business, Lifetime).
2. **Snapping & Connections (Admin)**: The user drags and drops nodes in the canvas (`admin/js/formflow-node-editor.js`). Snapping logic calculates layout offsets relatively to avoid coordinate shifting.
3. **Preview (Admin)**: `admin/js/formflow-preview.js` listens to graph changes and renders a live CSS-animated HTML preview in a dedicated side panel.
4. **Saving (Admin)**: Upon saving the `formflow_form` custom post type, the JSON is saved to post meta `_formflow_data`.
5. **Rendering (Frontend)**: The `[formflow id="X"]` shortcode loads the JSON, parses the nodes, and renders standard HTML form elements (`public/partials/formflow-public-display.php`).
6. **Submission (Frontend)**: AJAX POST request is sent to `wp_ajax_formflow_submit`.
7. **Processing (Backend)**: Data runs through the `FormFlow_Spam_Engine`. If clean, an email is sent to the site admin.
