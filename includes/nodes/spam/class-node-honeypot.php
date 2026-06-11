<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Honeypot extends FormFlow_Node {

    public function get_id() {
        return 'honeypot';
    }

    public function get_name() {
        return 'Honeypot';
    }

    public function get_description() {
        return 'Invisible field that catches automated bot submissions.';
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
            'fields'  => array()
        );
    }
}
