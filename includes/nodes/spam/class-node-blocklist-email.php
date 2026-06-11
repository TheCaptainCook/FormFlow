<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Blocklist_Email extends FormFlow_Node {

    public function get_id() {
        return 'blocklistEmail';
    }

    public function get_name() {
        return 'Blocklist Email';
    }

    public function get_description() {
        return 'Blocks submissions from specific email addresses or domains.';
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
                    'name' => 'blockedEmails',
                    'label' => 'Blocked Emails/Domains (comma separated)',
                    'type' => 'text',
                    'placeholder' => 'spam@spam.com, @baddomain.com',
                ),
            )
        );
    }
}
