<?php
/**
 * Node: Validate Max Value
 * Ensures a number is less than or equal to X.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Max_Value extends FormFlow_Node {

    public function get_id() {
        return 'validateMaxValue';
    }

    public function get_name() {
        return 'Max Value';
    }

    public function get_description() {
        return 'Ensures a number is less than or equal to X.';
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
                array( 'name' => 'max',           'label' => 'Maximum Value', 'type' => 'number', 'default' => 100 ),
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text',   'default' => 'Value must be no more than {max}.' ),
            )
        );
    }
}
