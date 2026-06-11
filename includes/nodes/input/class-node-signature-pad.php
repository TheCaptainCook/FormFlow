<?php
/**
 * Node: Signature Pad
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Signature_Pad extends FormFlow_Node {

    public function get_id() {
        return 'signaturePad';
    }

    public function get_name() {
        return 'Signature Pad';
    }

    public function get_description() {
        return 'A canvas for drawing a digital signature.';
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
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Signature Pad' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
