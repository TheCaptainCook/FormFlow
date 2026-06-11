<?php
/**
 * Abstract Base Class for all FormFlow Nodes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

abstract class FormFlow_Node {

    /**
     * Returns the unique identifier for this node type (e.g., 'textField')
     *
     * @return string
     */
    abstract public function get_id();

    /**
     * Returns the display name for the node (e.g., 'Text Field')
     *
     * @return string
     */
    abstract public function get_name();

    /**
     * Returns a short description of what the node does
     *
     * @return string
     */
    abstract public function get_description();

    /**
     * Returns the category this node belongs to (e.g., 'input', 'validation', 'action')
     *
     * @return string
     */
    abstract public function get_category();

    /**
     * Returns the pricing tier required for this node ('free', 'pro', 'business', 'lifetime')
     *
     * @return string
     */
    abstract public function get_tier();

    /**
     * Returns the visual configuration for the node editor canvas
     *
     * @return array
     */
    abstract public function get_js_config();

    /**
     * Determines whether this node renders visible HTML on the frontend form.
     * Nodes that only apply logic (validation, spam, logic, etc.) should return false.
     * Input/Field nodes and the submit button return true.
     *
     * @return bool
     */
    public function is_visual() {
        return true;
    }


    /**
     * Checks if the current user has access to this node based on their Freemius plan.
     *
     * @return bool
     */
    public function is_accessible() {
        $tier = $this->get_tier();

        if ( 'free' === $tier ) {
            return true;
        }

        // If the Freemius helper doesn't exist, assume we are in a pure free version without SDK initialized properly.
        if ( ! function_exists( 'for_fsrealfree' ) ) {
            return false;
        }

        // If premium code is not allowed to run at all
        if ( ! for_fsrealfree()->can_use_premium_code__premium_only() ) {
            return false;
        }

        $fs = for_fsrealfree();

        // Check plan access logic
        if ( 'pro' === $tier ) {
            return $fs->is_plan( 'pro' ) || $fs->is_plan( 'business' ) || $fs->is_plan( 'lifetime' );
        }

        if ( 'business' === $tier ) {
            return $fs->is_plan( 'business' ) || $fs->is_plan( 'lifetime' );
        }

        if ( 'lifetime' === $tier ) {
            return $fs->is_plan( 'lifetime' );
        }

        return false;
    }

    /**
     * Get the JSON-serializable array of the node definition
     *
     * @return array
     */
    public function to_array() {
        return array(
            'id'            => $this->get_id(),
            'name'          => $this->get_name(),
            'description'   => $this->get_description(),
            'category'      => $this->get_category(),
            'tier'          => $this->get_tier(),
            'is_accessible' => $this->is_accessible(),
            'is_visual'     => $this->is_visual(),
            'config'        => $this->get_js_config(),
        );
    }
}
