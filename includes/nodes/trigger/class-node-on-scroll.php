<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class FormFlow_Node_On_Scroll extends FormFlow_Node {

    public function get_id() {
        return 'onScroll';
    }

    public function get_name() {
        return 'On Scroll';
    }

    public function get_description() {
        return 'Triggers the flow when the user scrolls past a certain percentage of the page.';
    }

    public function get_category() {
        return 'trigger';
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
                    'name'    => 'scrollPercentage',
                    'label'   => 'Scroll %',
                    'type'    => 'number',
                    'default' => 50
                )
            )
        );
    }
}
