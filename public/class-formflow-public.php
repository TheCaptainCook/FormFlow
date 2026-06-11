<?php

/**
 * The public-facing functionality of the plugin.
 */
class FormFlow_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		// wp_enqueue_style( $this->plugin_name, FORMFLOW_PLUGIN_URL . 'public/css/formflow-public.css', array(), $this->version, 'all' );
        // Basic styles could be added here
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, FORMFLOW_PLUGIN_URL . 'public/js/formflow-public.js', array( 'jquery' ), $this->version, true );
        
        wp_localize_script( $this->plugin_name, 'formflowPublic', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ) );
	}

    public function render_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'id' => 0,
        ), $atts, 'formflow' );

        $shortcode_id = sanitize_text_field( $atts['id'] );
        if ( empty( $shortcode_id ) ) {
            return '<p>' . __( 'Invalid form ID.', 'formflow' ) . '</p>';
        }

        $form_id = 0;
        
        $forms = get_posts( array(
            'post_type'  => 'formflow',
            'meta_key'   => '_formflow_custom_id',
            'meta_value' => $shortcode_id,
            'post_status'=> 'any',
            'fields'     => 'ids',
            'posts_per_page' => 1
        ) );

        if ( ! empty( $forms ) ) {
            $matched_id = $forms[0];
            $is_enabled = get_post_meta( $matched_id, '_formflow_use_custom_id', true );
            if ( $is_enabled === 'yes' ) {
                $form_id = $matched_id;
            }
        }

        if ( ! $form_id ) {
            $form_id = intval( $shortcode_id );
        }

        if ( ! $form_id || get_post_type( $form_id ) !== 'formflow' ) {
            return '<p>' . __( 'Invalid form ID.', 'formflow' ) . '</p>';
        }

        $form_data_json = get_post_meta( $form_id, '_formflow_data', true );
        if ( empty( $form_data_json ) ) {
            return '<p>' . __( 'Form is empty.', 'formflow' ) . '</p>';
        }

        $form_data = json_decode( $form_data_json, true );
        if ( ! $form_data || empty( $form_data['nodes'] ) ) {
            return '<p>' . __( 'Error parsing form data.', 'formflow' ) . '</p>';
        }

        ob_start();
        include FORMFLOW_PLUGIN_DIR . 'public/partials/formflow-public-display.php';
        return ob_get_clean();
    }

    public function handle_form_submission() {
        if ( ! isset( $_POST['form_id'] ) || ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'formflow_submit_nonce_' . intval( $_POST['form_id'] ) ) ) {
            wp_send_json_error( array( 'message' => __( 'Security check failed.', 'formflow' ) ) );
        }

        $form_id = intval( $_POST['form_id'] );
        $form_data_json = get_post_meta( $form_id, '_formflow_data', true );
        $form_data = json_decode( $form_data_json, true );

        // Run through Spam Engine
        $spam_engine = new FormFlow_Spam_Engine();
        $is_spam = $spam_engine->check_submission( $_POST, $form_data );

        if ( $is_spam ) {
            wp_send_json_error( array( 'message' => __( 'Submission flagged as spam.', 'formflow' ) ) );
        }

        // Processing form logic (e.g., sending email)
        // This is a simplified version, normally you'd map fields to an email template
        $to = get_option( 'admin_email' );
        $subject = 'New Form Submission from FormFlow';
        $body = "New submission for form ID: $form_id\n\n";

        foreach ( $_POST as $key => $value ) {
            if ( $key !== 'action' && $key !== 'nonce' && $key !== 'form_id' ) {
                $body .= sanitize_text_field( $key ) . ": " . sanitize_textarea_field( $value ) . "\n";
            }
        }

        wp_mail( $to, $subject, $body );

        wp_send_json_success( array( 'message' => __( 'Message sent successfully!', 'formflow' ) ) );
    }

}
