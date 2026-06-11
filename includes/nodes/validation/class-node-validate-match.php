<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Match extends FormFlow_Node {

    public function get_id() {
        return 'validateMatch';
    }

    public function get_name() {
        return 'Fields Match';
    }

    public function get_description() {
        return 'Ensures two fields match (e.g. Password Confirmation).';
    }

    public function get_category() {
        return 'validation';
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
                    'name' => 'matchTargetId',
                    'label' => 'Target Field ID',
                    'type' => 'text',
                    'placeholder' => 'node_12345',
                ),
            )
        );
    }
}
