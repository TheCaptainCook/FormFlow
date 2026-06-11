<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Min_Value extends FormFlow_Node {

    public function get_id() {
        return 'validateMinValue';
    }

    public function get_name() {
        return 'Minimum Value';
    }

    public function get_description() {
        return 'Ensures a number is greater than or equal to a value.';
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
                    'name' => 'minValue',
                    'label' => 'Minimum Value',
                    'type' => 'number',
                    'default' => 0,
                ),
            )
        );
    }
}
