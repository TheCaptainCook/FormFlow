<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Timer extends FormFlow_Node {

    public function get_id() {
        return 'onTimer';
    }

    public function get_name() {
        return 'On Timer';
    }

    public function get_description() {
        return 'Triggers the form flow after a specific delay.';
    }

    public function get_category() {
        return 'trigger';
    }

    public function get_tier() {
        return 'business';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array(
                array(
                    'name'    => 'delaySeconds',
                    'label'   => 'Delay (seconds)',
                    'type'    => 'number',
                    'default' => 5
                )
            )
        );
    }
}
