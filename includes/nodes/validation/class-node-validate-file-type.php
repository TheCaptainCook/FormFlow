<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_File_Type extends FormFlow_Node {

    public function get_id() {
        return 'validateFileType';
    }

    public function get_name() {
        return 'File Type';
    }

    public function get_description() {
        return 'Restricts uploaded files to specific MIME types.';
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
                    'name' => 'allowedTypes',
                    'label' => 'Allowed Extensions',
                    'type' => 'text',
                    'placeholder' => 'pdf, docx, jpg',
                ),
            )
        );
    }
}
