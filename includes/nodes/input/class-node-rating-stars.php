<?php
/**
 * Node: Rating Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Rating_Stars extends FormFlow_Node {

    public function get_id() {
        return 'ratingStars';
    }

    public function get_name() {
        return 'Rating Stars';
    }

    public function get_description() {
        return 'Clickable stars for user ratings.';
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
                array( 'name' => 'label', 'label' => 'Field Label', 'type' => 'text', 'default' => 'Rating Stars' ),
                array( 'name' => 'showLabel', 'label' => 'Show Label', 'type' => 'checkbox', 'default' => true ),
                array( 'name' => 'required', 'label' => 'Required', 'type' => 'checkbox', 'default' => false )
            )
        );
    }
}
