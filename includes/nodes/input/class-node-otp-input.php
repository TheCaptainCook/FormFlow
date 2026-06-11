<?php
/**
 * Node: OTP Input
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Otp_Input extends FormFlow_Node {

    public function get_id() {
        return 'otpInput';
    }

    public function get_name() {
        return 'OTP Input';
    }

    public function get_description() {
        return 'One-time password input field.';
    }

    public function get_category() {
        return 'input';
    }

    public function get_tier() {
        return 'lifetime';
    }

    public function get_js_config() {
        return array(
            'inputs'  => array('priority-in', 'cond-in'),
            'outputs' => array('priority-out', 'cond-out'),
            'fields'  => array(
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'OTP Input' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false ),
                array( 'name' => 'digits', 'label' => 'Number of Digits', 'type' => 'number', 'default' => 6 )
            )
        );
    }
}
