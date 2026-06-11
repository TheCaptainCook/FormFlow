<?php
/**
 * Node: Date & Time
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Datetime_Field extends FormFlow_Node {

    public function get_id() {
        return 'datetimeField';
    }

    public function get_name() {
        return 'Date & Time';
    }

    public function get_description() {
        return 'A combined date and time picker.';
    }

    public function get_category() {
        return 'input';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Date & Time' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
