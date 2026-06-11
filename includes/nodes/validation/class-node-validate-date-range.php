<?php
/**
 * Node: Validate Date Range
 * Ensures a date falls between two others.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Date_Range extends FormFlow_Node {

    public function get_id() {
        return 'validateDateRange';
    }

    public function get_name() {
        return 'Date Range';
    }

    public function get_description() {
        return 'Ensures a date falls between two others.';
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
                array( 'name' => 'min_date',      'label' => 'Min Date (YYYY-MM-DD)', 'type' => 'text', 'default' => '' ),
                array( 'name' => 'max_date',      'label' => 'Max Date (YYYY-MM-DD)', 'type' => 'text', 'default' => '' ),
                array( 'name' => 'error_message', 'label' => 'Error Message',          'type' => 'text', 'default' => 'Date must be between {min_date} and {max_date}.' ),
            )
        );
    }
}
