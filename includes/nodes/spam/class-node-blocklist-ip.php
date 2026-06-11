<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Blocklist_Ip extends FormFlow_Node {

    public function get_id() {
        return 'blocklistIp';
    }

    public function get_name() {
        return 'Blocklist IP';
    }

    public function get_description() {
        return 'Blocks submissions from specific IP addresses.';
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
            'fields'  => array(
                array(
                    'name' => 'blockedIps',
                    'label' => 'Blocked IPs (comma separated)',
                    'type' => 'text',
                    'placeholder' => '192.168.1.1, 10.0.0.0/8',
                ),
            )
        );
    }
}
