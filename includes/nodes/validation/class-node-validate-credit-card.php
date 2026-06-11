<?php
/**
 * Node: Validate Credit Card
 * Checks if a number could be a valid credit card using the Luhn algorithm.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Credit_Card extends FormFlow_Node {

    public function get_id() {
        return 'validateCreditCard';
    }

    public function get_name() {
        return 'Credit Card';
    }

    public function get_description() {
        return 'Checks if a number could be a valid credit card (Luhn algorithm).';
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
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text', 'default' => 'Please enter a valid credit card number.' ),
            )
        );
    }
}
