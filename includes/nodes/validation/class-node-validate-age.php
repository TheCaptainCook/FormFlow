<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_Validate_Age extends FormFlow_Node {

    public function get_id() {
        return 'validateAge';
    }

    public function get_name() {
        return 'Minimum Age';
    }

    public function get_description() {
        return 'Validates a user is over a certain age.';
    }

    public function get_category() {
        return 'validation';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array(),
            'outputs' => array(),
            'fields'  => array(
                array(
                    'name' => 'minAge',
                    'label' => 'Minimum Age',
                    'type' => 'number',
                    'default' => 18,
                ),
            )
        );
    }
}
