<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Time_Trap extends FormFlow_Node {

    public function get_id() {
        return 'timeTrap';
    }

    public function get_name() {
        return 'Time Trap';
    }

    public function get_description() {
        return 'Measures time between load and submission to block instant bots.';
    }

    public function get_category() {
        return 'spam';
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
                    'name' => 'minSeconds',
                    'label' => 'Min Seconds',
                    'type' => 'number',
                    'default' => 3,
                ),
            )
        );
    }
}
