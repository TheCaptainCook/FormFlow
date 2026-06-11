<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_File_Size extends FormFlow_Node {

    public function get_id() {
        return 'validateFileSize';
    }

    public function get_name() {
        return 'File Size';
    }

    public function get_description() {
        return 'Restricts uploaded files to a maximum MB size.';
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
                    'name' => 'maxMb',
                    'label' => 'Max Size (MB)',
                    'type' => 'number',
                    'default' => 5,
                ),
            )
        );
    }
}
