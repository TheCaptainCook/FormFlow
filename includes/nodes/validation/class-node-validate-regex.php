<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Regex extends FormFlow_Node {

    public function get_id() {
        return 'validateRegex';
    }

    public function get_name() {
        return 'Custom Regex';
    }

    public function get_description() {
        return 'Validates input against a custom Regular Expression.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'pro';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array(
                array(
                    'name' => 'pattern',
                    'label' => 'Regex Pattern',
                    'type' => 'text',
                    'placeholder' => '^[a-z]+$',
                ),
            )
        );
    }
}
