<?php
/**
 * Node: Hidden Field
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Hidden_Field extends FormFlow_Node {

    public function get_id() {
        return 'hiddenField';
    }

    public function get_name() {
        return 'Hidden Field';
    }

    public function get_description() {
        return 'Invisible field for passing hidden data.';
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
                array( 'name' => 'name_attr', 'label' => 'Field Name', 'type' => 'text', 'default' => 'hidden_field' ),
                array( 'name' => 'value', 'label' => 'Hidden Value', 'type' => 'text', 'default' => '' )
            )
        );
    }
}
