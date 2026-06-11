<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Vat extends FormFlow_Node {

    public function get_id() {
        return 'validateVAT';
    }

    public function get_name() {
        return 'VAT Number';
    }

    public function get_description() {
        return 'Validates European VAT numbers.';
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
