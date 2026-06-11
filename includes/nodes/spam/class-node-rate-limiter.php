<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Rate_Limiter extends FormFlow_Node {

    public function get_id() {
        return 'rateLimiter';
    }

    public function get_name() {
        return 'Rate Limiter';
    }

    public function get_description() {
        return 'Restricts submissions from a single IP within a timeframe.';
    }

    public function get_category() {
        return 'spam';
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
                    'name' => 'maxSubmissions',
                    'label' => 'Max Submissions',
                    'type' => 'number',
                    'default' => 5,
                ),
                array(
                    'name' => 'timeframeMinutes',
                    'label' => 'Timeframe (Minutes)',
                    'type' => 'number',
                    'default' => 60,
                ),
            )
        );
    }
}
