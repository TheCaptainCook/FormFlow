<?php
/**
 * Node: Range Slider
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Range_Slider extends FormFlow_Node {

    public function get_id() {
        return 'rangeSlider';
    }

    public function get_name() {
        return 'Range Slider';
    }

    public function get_description() {
        return 'A sliding bar for selecting a numeric value.';
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
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Range Slider' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false ),
                array( 'name' => 'min', 'label' => 'Min Value', 'type' => 'number', 'default' => 0 ),
                array( 'name' => 'max', 'label' => 'Max Value', 'type' => 'number', 'default' => 100 ),
                array( 'name' => 'step', 'label' => 'Step', 'type' => 'number', 'default' => 1 )
            )
        );
    }
}
