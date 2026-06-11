<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Postal_Code extends FormFlow_Node {

    public function get_id() {
        return 'validatePostalCode';
    }

    public function get_name() {
        return 'Postal Code';
    }

    public function get_description() {
        return 'Validates international postal code formats.';
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
            'fields'  => array(
                array(
                    'name' => 'countryCode',
                    'label' => 'Country Code',
                    'type' => 'text',
                    'placeholder' => 'US',
                ),
            )
        );
    }
}
