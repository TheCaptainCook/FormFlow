<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Iban extends FormFlow_Node {

    public function get_id() {
        return 'validateIBAN';
    }

    public function get_name() {
        return 'IBAN';
    }

    public function get_description() {
        return 'Validates International Bank Account Numbers.';
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
