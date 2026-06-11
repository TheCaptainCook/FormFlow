<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Unique extends FormFlow_Node {

    public function get_id() {
        return 'validateUnique';
    }

    public function get_name() {
        return 'Unique Database';
    }

    public function get_description() {
        return 'Ensures a value does not already exist in the database.';
    }

    public function get_category() {
        return 'validation';
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
                    'name' => 'dbTable',
                    'label' => 'Table Name',
                    'type' => 'text',
                    'placeholder' => 'wp_users',
                ),
                array(
                    'name' => 'dbColumn',
                    'label' => 'Column Name',
                    'type' => 'text',
                    'placeholder' => 'user_email',
                ),
            )
        );
    }
}
