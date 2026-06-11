<?php
/**
 * Node: Address Autocomplete
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Address_Autocomplete extends FormFlow_Node {

    public function get_id() {
        return 'addressAutocomplete';
    }

    public function get_name() {
        return 'Address Autocomplete';
    }

    public function get_description() {
        return 'Input field with address autocomplete.';
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
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Address Autocomplete' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
