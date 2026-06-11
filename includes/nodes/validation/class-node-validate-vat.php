<?php
/**
 * Node: Validate VAT
 * Checks European VAT number format.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_VAT extends FormFlow_Node {

    public function get_id() {
        return 'validateVAT';
    }

    public function get_name() {
        return 'VAT Number';
    }

    public function get_description() {
        return 'Checks European VAT number format.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text', 'default' => 'Please enter a valid VAT number.' ),
            )
        );
    }
}
