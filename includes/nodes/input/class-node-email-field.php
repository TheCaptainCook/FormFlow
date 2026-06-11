<?php
/**
 * Node: Email Field
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Email_Field extends FormFlow_Node {

    public function get_id() {
        return 'emailField';
    }

    public function get_name() {
        return 'Email Field';
    }

    public function get_description() {
        return 'Input field validated for email addresses.';
    }

    public function get_category() {
        return 'input';
    }

    public function get_tier() {
        return 'free';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Email Field' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'placeholder', 'label' => 'Placeholder', 'type' => 'text', 'default' => '' ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
