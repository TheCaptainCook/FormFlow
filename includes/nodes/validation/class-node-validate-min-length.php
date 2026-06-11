<?php
/**
 * Node: Validate Min Length
 * Ensures text is longer than X characters.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Min_Length extends FormFlow_Node {

    public function get_id() {
        return 'validateMinLength';
    }

    public function get_name() {
        return 'Min Length';
    }

    public function get_description() {
        return 'Ensures text is longer than X characters.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'free';
    }

    public function is_visual() { return false; }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'min',           'label' => 'Min Characters', 'type' => 'number', 'default' => 3 ),
                array( 'name' => 'error_message', 'label' => 'Error Message',  'type' => 'text',   'default' => 'Must be at least {min} characters.' ),
            )
        );
    }
}
