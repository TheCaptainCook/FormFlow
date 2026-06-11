<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Button_Click extends FormFlow_Node {

    public function get_id() {
        return 'onButtonClick';
    }

    public function get_name() {
        return 'On Button Click';
    }

    public function get_description() {
        return 'Triggers the flow when a specific CSS selector is clicked.';
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
            'fields'  => array(
                array(
                    'name'        => 'selector',
                    'label'       => 'CSS Selector',
                    'type'        => 'text',
                    'placeholder' => '#my-button, .btn-submit',
                    'default'     => ''
                )
            )
        );
    }
}
