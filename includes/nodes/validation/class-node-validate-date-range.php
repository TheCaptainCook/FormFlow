<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Date_Range extends FormFlow_Node {

    public function get_id() {
        return 'validateDateRange';
    }

    public function get_name() {
        return 'Date Range';
    }

    public function get_description() {
        return 'Ensures a date falls within a specific range.';
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
                    'name' => 'minDate',
                    'label' => 'Min Date',
                    'type' => 'text',
                    'placeholder' => 'YYYY-MM-DD',
                ),
                array(
                    'name' => 'maxDate',
                    'label' => 'Max Date',
                    'type' => 'text',
                    'placeholder' => 'YYYY-MM-DD',
                ),
            )
        );
    }
}
