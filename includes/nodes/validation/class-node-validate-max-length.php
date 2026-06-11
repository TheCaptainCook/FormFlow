<?php
/**
 * Node: Validate Max Length
 * Ensures text is shorter than X characters.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Max_Length extends FormFlow_Node {

    public function get_id() {
        return 'validateMaxLength';
    }

    public function get_name() {
        return 'Max Length';
    }

    public function get_description() {
        return 'Ensures text is shorter than X characters.';
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
                array( 'name' => 'max',           'label' => 'Max Characters', 'type' => 'number', 'default' => 255 ),
                array( 'name' => 'error_message', 'label' => 'Error Message',  'type' => 'text',   'default' => 'Must be no more than {max} characters.' ),
            )
        );
    }
}
