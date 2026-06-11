<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Email extends FormFlow_Node {

    public function get_id() {
        return 'validateEmail';
    }

    public function get_name() {
        return 'Valid Email';
    }

    public function get_description() {
        return 'Validates standard email format.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'free';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array()
        );
    }
}
