<?php
/**
 * Node: Validate Unique
 * Checks if a value already exists in the database.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Unique extends FormFlow_Node {

    public function get_id() {
        return 'validateUnique';
    }

    public function get_name() {
        return 'Unique Value';
    }

    public function get_description() {
        return 'Checks if a value already exists in the database.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'business';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'db_table',      'label' => 'DB Table',      'type' => 'text', 'default' => 'wp_users' ),
                array( 'name' => 'db_column',     'label' => 'DB Column',     'type' => 'text', 'default' => 'user_email' ),
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text', 'default' => 'This value is already taken.' ),
            )
        );
    }
}
