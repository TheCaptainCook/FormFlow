<?php
/**
 * Node: Validate Email
 * Checks if the input matches email@domain.com format.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Email extends FormFlow_Node {

    public function get_id() {
        return 'validateEmail';
    }

    public function get_name() {
        return 'Valid Email';
    }

    public function get_description() {
        return 'Checks if the input matches email@domain.com format.';
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
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text', 'default' => 'Please enter a valid email address.' ),
            )
        );
    }
}
