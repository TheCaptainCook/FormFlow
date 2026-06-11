<?php
/**
 * Node: Validate File Size
 * Restricts uploaded file size (e.g., max 5MB).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_File_Size extends FormFlow_Node {

    public function get_id() {
        return 'validateFileSize';
    }

    public function get_name() {
        return 'File Size';
    }

    public function get_description() {
        return 'Restricts uploaded file size (e.g., max 5MB).';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'business';
    }

    public function is_visual() { return false; }

    public function get_js_config() {
        return array(
            'inputs'  => array( 'cond-in' ),
            'outputs' => array( 'cond-out' ),
            'fields'  => array(
                array( 'name' => 'max_size_mb',   'label' => 'Max Size (MB)', 'type' => 'number', 'default' => 5 ),
                array( 'name' => 'error_message', 'label' => 'Error Message', 'type' => 'text',   'default' => 'File exceeds the maximum allowed size of {max_size_mb}MB.' ),
            )
        );
    }
}
