<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Max_Value extends FormFlow_Node {

    public function get_id() {
        return 'validateMaxValue';
    }

    public function get_name() {
        return 'Maximum Value';
    }

    public function get_description() {
        return 'Ensures a number is less than or equal to a value.';
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
                    'name' => 'maxValue',
                    'label' => 'Maximum Value',
                    'type' => 'number',
                    'default' => 100,
                ),
            )
        );
    }
}
