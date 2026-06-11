<?php
/**
 * Node: Textarea
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Textarea_Field extends FormFlow_Node {

    public function get_id() {
        return 'textareaField';
    }

    public function get_name() {
        return 'Textarea';
    }

    public function get_description() {
        return 'A multi-line text input area.';
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
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Textarea' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'placeholder', 'label' => 'Placeholder', 'type' => 'text', 'default' => '' ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false ),
                array( 'name' => 'rows', 'label' => 'Rows', 'type' => 'number', 'default' => 4 )
            )
        );
    }
}
