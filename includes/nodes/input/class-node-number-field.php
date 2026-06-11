<?php
/**
 * Node: Number Field
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Number_Field extends FormFlow_Node {

    public function get_id() {
        return 'numberField';
    }

    public function get_name() {
        return 'Number Field';
    }

    public function get_description() {
        return 'Input field restricted to numeric values.';
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
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Number Field' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'placeholder', 'label' => 'Placeholder', 'type' => 'text', 'default' => '' ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false ),
                array( 'name' => 'min', 'label' => 'Min Value', 'type' => 'number', 'default' => '' ),
                array( 'name' => 'max', 'label' => 'Max Value', 'type' => 'number', 'default' => '' )
            )
        );
    }
}
