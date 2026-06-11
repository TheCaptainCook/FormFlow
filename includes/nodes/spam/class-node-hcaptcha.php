<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Hcaptcha extends FormFlow_Node {

    public function get_id() {
        return 'hcaptcha';
    }

    public function get_name() {
        return 'hCaptcha';
    }

    public function get_description() {
        return 'Integrates hCaptcha.';
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
                    'name' => 'siteKey',
                    'label' => 'Site Key',
                    'type' => 'text',
                    'placeholder' => '...',
                ),
                array(
                    'name' => 'secretKey',
                    'label' => 'Secret Key',
                    'type' => 'password',
                    'placeholder' => '...',
                ),
            )
        );
    }
}
