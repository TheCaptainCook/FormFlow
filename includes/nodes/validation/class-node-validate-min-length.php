<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Min_Length extends FormFlow_Node {

    public function get_id() {
        return 'validateMinLength';
    }

    public function get_name() {
        return 'Minimum Length';
    }

    public function get_description() {
        return 'Ensures a string meets a minimum character count.';
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
                    'name' => 'minLength',
                    'label' => 'Min Characters',
                    'type' => 'number',
                    'default' => 3,
                ),
            )
        );
    }
}
