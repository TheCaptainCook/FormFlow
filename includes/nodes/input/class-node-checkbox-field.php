<?php
/**
 * Node: Checkbox
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Checkbox_Field extends FormFlow_Node {

    public function get_id() {
        return 'checkboxField';
    }

    public function get_name() {
        return 'Checkbox';
    }

    public function get_description() {
        return 'A single toggleable checkbox.';
    }

    public function get_category() {
        return 'input';
    }

    public function get_tier() {
        return 'free';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Checkbox' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'checkboxText', 'label' => 'Checkbox Text', 'type' => 'text', 'default' => 'Check me' ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
