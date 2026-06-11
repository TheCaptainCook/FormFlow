<?php
/**
 * Node: File Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_File_Upload extends FormFlow_Node {

    public function get_id() {
        return 'fileUpload';
    }

    public function get_name() {
        return 'File Upload';
    }

    public function get_description() {
        return 'Allows users to upload files.';
    }

    public function get_category() {
        return 'input';
    }

    public function get_tier() {
        return 'pro';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'File Upload' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false ),
                array( 'name' => 'allowed_types', 'label' => 'Allowed Extensions (comma-separated)', 'type' => 'text', 'default' => 'jpg, png, pdf' ),
                array( 'name' => 'max_size', 'label' => 'Max Size (MB)', 'type' => 'number', 'default' => 5 )
            )
        );
    }
}
