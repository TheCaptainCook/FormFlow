<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Required extends FormFlow_Node {

    public function get_id() {
        return 'validateRequired';
    }

    public function get_name() {
        return 'Required';
    }

    public function get_description() {
        return 'Ensures a field is not empty.';
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
