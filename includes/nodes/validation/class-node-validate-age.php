<?php
/**
 * Node: Validate Age
 * Ensures the user is at least X years old based on a date field.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Age extends FormFlow_Node {

    public function get_id() {
        return 'validateAge';
    }

    public function get_name() {
        return 'Min Age';
    }

    public function get_description() {
        return 'Ensures the user is at least X years old based on a date field.';
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
                array( 'name' => 'min_age',       'label' => 'Minimum Age (years)', 'type' => 'number', 'default' => 18 ),
                array( 'name' => 'error_message', 'label' => 'Error Message',        'type' => 'text',   'default' => 'You must be at least {min_age} years old.' ),
            )
        );
    }
}
