<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Form_Submit extends FormFlow_Node {

    public function get_id() {
        return 'onFormSubmit';
    }

    public function get_name() {
        return 'On Form Submit';
    }

    public function get_description() {
        return 'Standard trigger when the form\'s native submit button is pressed.';
    }

    public function get_category() {
        return 'trigger';
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
