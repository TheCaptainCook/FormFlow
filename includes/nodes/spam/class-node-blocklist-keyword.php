<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Blocklist_Keyword extends FormFlow_Node {

    public function get_id() {
        return 'blocklistKeyword';
    }

    public function get_name() {
        return 'Blocklist Keyword';
    }

    public function get_description() {
        return 'Blocks submissions containing restricted words.';
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
                    'name' => 'blockedKeywords',
                    'label' => 'Blocked Keywords (comma separated)',
                    'type' => 'text',
                    'placeholder' => 'viagra, crypto',
                ),
            )
        );
    }
}
