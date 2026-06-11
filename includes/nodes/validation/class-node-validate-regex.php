<?php
/**
 * Node: Validate Regex
 * Checks input against a custom regular expression.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Regex extends FormFlow_Node {

    public function get_id() {
        return 'validateRegex';
    }

    public function get_name() {
        return 'Regex Pattern';
    }

    public function get_description() {
        return 'Checks input against a custom regular expression.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'pro';
    }

    public function is_visual() { return false; }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'pattern',       'label' => 'Regex Pattern',   'type' => 'text', 'default' => '^[a-zA-Z]+$' ),
                array( 'name' => 'error_message', 'label' => 'Error Message',   'type' => 'text', 'default' => 'Invalid format.' ),
            )
        );
    }
}
