<?php
/**
 * Node: Validate IBAN
 * Checks international bank account number format.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_IBAN extends FormFlow_Node {

    public function get_id() {
        return 'validateIBAN';
    }

    public function get_name() {
        return 'IBAN';
    }

    public function get_description() {
        return 'Checks international bank account number format.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function is_visual() { return false; }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text', 'default' => 'Please enter a valid IBAN.' ),
            )
        );
    }
}
