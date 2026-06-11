<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Fingerprint extends FormFlow_Node {

    public function get_id() {
        return 'fingerprint';
    }

    public function get_name() {
        return 'Browser Fingerprint';
    }

    public function get_description() {
        return 'Advanced browser fingerprinting to detect repeat offenders.';
    }

    public function get_category() {
        return 'spam';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array()
        );
    }
}
