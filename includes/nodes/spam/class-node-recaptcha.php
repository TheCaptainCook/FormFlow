<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Recaptcha extends FormFlow_Node {

    public function get_id() {
        return 'recaptcha';
    }

    public function get_name() {
        return 'Google reCAPTCHA';
    }

    public function get_description() {
        return 'Integrates Google reCAPTCHA v2/v3.';
    }

    public function get_category() {
        return 'spam';
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
