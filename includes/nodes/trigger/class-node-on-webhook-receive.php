<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Webhook_Receive extends FormFlow_Node {

    public function get_id() {
        return 'onWebhookReceive';
    }

    public function get_name() {
        return 'On Webhook Receive';
    }

    public function get_description() {
        return 'Advanced server-side trigger when a webhook is received.';
    }

    public function get_category() {
        return 'trigger';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        // Use a disabled text field to show a dummy webhook URL as this is usually generated server-side.
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array(
                array(
                    'name'        => 'webhookUrl',
                    'label'       => 'Webhook URL',
                    'type'        => 'text',
                    'default'     => 'https://yoursite.com/wp-json/formflow/v1/webhook',
                )
            )
        );
    }
}
