<?php
/**
 * Node: Validate File Type
 * Restricts uploaded file types (e.g., only PDF).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_File_Type extends FormFlow_Node {

    public function get_id() {
        return 'validateFileType';
    }

    public function get_name() {
        return 'File Type';
    }

    public function get_description() {
        return 'Restricts uploaded file types (e.g., only PDF).';
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
                array( 'name' => 'allowed_types',  'label' => 'Allowed Types (comma-separated)', 'type' => 'text', 'default' => 'pdf, jpg, png' ),
                array( 'name' => 'error_message',  'label' => 'Error Message',                   'type' => 'text', 'default' => 'File type not allowed.' ),
            )
        );
    }
}
