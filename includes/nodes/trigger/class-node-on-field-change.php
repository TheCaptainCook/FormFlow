<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Field_Change extends FormFlow_Node {

    public function get_id() {
        return 'onFieldChange';
    }

    public function get_name() {
        return 'On Field Change';
    }

    public function get_description() {
        return 'Triggers when a specific field value changes.';
    }

    public function get_category() {
        return 'trigger';
    }

    public function get_tier() {
        return 'pro';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array(
                array(
                    'name'        => 'targetFieldId',
                    'label'       => 'Target Field ID',
                    'type'        => 'text',
                    'placeholder' => 'node_12345',
                    'default'     => ''
                )
            )
        );
    }
}
