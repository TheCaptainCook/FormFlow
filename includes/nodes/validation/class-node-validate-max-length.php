<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Max_Length extends FormFlow_Node {

    public function get_id() {
        return 'validateMaxLength';
    }

    public function get_name() {
        return 'Maximum Length';
    }

    public function get_description() {
        return 'Ensures a string does not exceed a character count.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'free';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array(
                array(
                    'name' => 'maxLength',
                    'label' => 'Max Characters',
                    'type' => 'number',
                    'default' => 255,
                ),
            )
        );
    }
}
