<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Schedule extends FormFlow_Node {

    public function get_id() {
        return 'onSchedule';
    }

    public function get_name() {
        return 'On Schedule';
    }

    public function get_description() {
        return 'Triggers on a specific date and time.';
    }

    public function get_category() {
        return 'trigger';
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
                    'name'        => 'scheduleTime',
                    'label'       => 'Date/Time',
                    'type'        => 'text',
                    'placeholder' => 'YYYY-MM-DD HH:MM',
                    'default'     => ''
                )
            )
        );
    }
}
