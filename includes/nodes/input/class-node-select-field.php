<?php
/**
 * Node: Select Dropdown
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Select_Field extends FormFlow_Node {

    public function get_id() {
        return 'selectField';
    }

    public function get_name() {
        return 'Select Dropdown';
    }

    public function get_description() {
        return 'A dropdown menu with selectable options.';
    }

    public function get_category() {
        return 'input';
    }

    public function get_tier() {
        return 'pro';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Select Dropdown' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'options', 'label' => 'Options (comma-separated)', 'type' => 'textarea', 'default' => 'Option 1, Option 2, Option 3' ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
