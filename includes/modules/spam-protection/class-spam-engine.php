<?php

/**
 * Handles spam protection and recommendation engine.
 */
class FormFlow_Spam_Engine {

    /**
     * Render honeypot field in the form.
     */
    public static function render_honeypot_field() {
        // A honeypot field is hidden from real users via CSS. Bots will fill it out.
        echo '<div style="display:none; visibility:hidden;">';
        echo '<label for="formflow_hp_email">Please leave this field empty</label>';
        echo '<input type="text" name="formflow_hp_email" id="formflow_hp_email" value="" tabindex="-1" autocomplete="off" />';
        echo '</div>';
    }

    /**
     * Check if a submission is spam.
     * 
     * @param array $post_data The $_POST data from the form submission.
     * @param array $form_data The JSON decoded form configuration.
     * @return bool True if spam is detected, false otherwise.
     */
    public function check_submission( $post_data, $form_data ) {
        // 1. Honeypot check
        if ( ! empty( $post_data['formflow_hp_email'] ) ) {
            return true; // Bot filled the honeypot
        }

        // 2. Simple Heuristic: Ensure essential nodes match the submitted data
        // For example, if there's an input node but no data was submitted for it
        if ( isset( $form_data['nodes'] ) ) {
            foreach ( $form_data['nodes'] as $node ) {
                if ( $node['type'] !== 'submit' && ! isset( $post_data[ $node['id'] ] ) ) {
                    // Field exists in form but wasn't sent in POST (might happen with bots bypassing the form UI)
                    // return true; 
                    // This is too strict for now since checkboxes/radio might be empty, 
                    // but for text inputs it might be a valid heuristic.
                }
            }
        }

        // 3. Simple Heuristic: Check for common spam words
        $spam_keywords = array( 'viagra', 'seo services', 'buy cheap', 'casino' );
        foreach ( $post_data as $key => $value ) {
            if ( $key !== 'action' && $key !== 'nonce' && $key !== 'form_id' ) {
                $content = strtolower( $value );
                foreach ( $spam_keywords as $keyword ) {
                    if ( strpos( $content, $keyword ) !== false ) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
