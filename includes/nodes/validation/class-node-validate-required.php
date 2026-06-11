<?php
/**
 * Node: Validate Required
 * Checks if a field has a value (not empty).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Required extends FormFlow_Node {

    public function get_id() {
        return 'validateRequired';
    }

    public function get_name() {
        return 'Required';
    }

    public function get_description() {
        return 'Checks if a field has a value (not empty).';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'free';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text', 'default' => 'This field is required.' ),
            )
        );
    }
}
