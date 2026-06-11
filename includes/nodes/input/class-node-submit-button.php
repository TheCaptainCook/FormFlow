<?php
/**
 * Node: Submit Button
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Submit_Button extends FormFlow_Node {

    public function get_id() {
        return 'submitButton';
    }

    public function get_name() {
        return 'Submit Button';
    }

    public function get_description() {
        return 'The core button used to submit the form data.';
    }

    public function get_category() {
        return 'action';
    }

    public function get_tier() {
        return 'free';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'buttonText', 'label' => 'Button Text', 'type' => 'text', 'default' => 'Submit Form' ),
                array( 'name' => 'buttonColor', 'label' => 'Button Color', 'type' => 'text', 'default' => '#2563eb' ),
                array( 'name' => 'textColor', 'label' => 'Text Color', 'type' => 'text', 'default' => '#ffffff' )
            )
        );
    }
}
