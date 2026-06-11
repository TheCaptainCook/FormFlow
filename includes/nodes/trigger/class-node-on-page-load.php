<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Page_Load extends FormFlow_Node {

    public function get_id() {
        return 'onPageLoad';
    }

    public function get_name() {
        return 'On Page Load';
    }

    public function get_description() {
        return 'Triggers the form flow immediately when the page loads.';
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
