<?php
/**
 * Node: Validate Match
 * Checks if two fields have identical values (e.g., password confirmation).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Match extends FormFlow_Node {

    public function get_id() {
        return 'validateMatch';
    }

    public function get_name() {
        return 'Fields Match';
    }

    public function get_description() {
        return 'Checks if two fields have identical values (e.g., password confirmation).';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'pro';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'match_target_id', 'label' => 'Target Field Node ID', 'type' => 'text',   'default' => '' ),
                array( 'name' => 'error_message',   'label' => 'Error Message',         'type' => 'text',   'default' => 'Fields do not match.' ),
            )
        );
    }
}
