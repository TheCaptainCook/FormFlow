<?php
/**
 * Node: Validate Postal Code
 * Checks format against country-specific postal codes.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Postal_Code extends FormFlow_Node {

    public function get_id() {
        return 'validatePostalCode';
    }

    public function get_name() {
        return 'Postal Code';
    }

    public function get_description() {
        return 'Checks format against country-specific postal codes.';
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
                array( 'name' => 'country',       'label' => 'Country Code (e.g. US, GB, DE)', 'type' => 'text', 'default' => 'US' ),
                array( 'name' => 'error_message', 'label' => 'Error Message',                   'type' => 'text', 'default' => 'Please enter a valid postal code.' ),
            )
        );
    }
}
