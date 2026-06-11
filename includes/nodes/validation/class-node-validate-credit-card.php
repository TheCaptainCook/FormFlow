<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Credit_Card extends FormFlow_Node {

    public function get_id() {
        return 'validateCreditCard';
    }

    public function get_name() {
        return 'Credit Card';
    }

    public function get_description() {
        return 'Validates a string using the Luhn algorithm.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array()
        );
    }
}
