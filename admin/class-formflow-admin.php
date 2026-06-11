<?php

/**
 * The admin-specific functionality of the plugin.
 */
class FormFlow_Admin {

	private $plugin_name;
	private $version;
	private $node_registry;

	public function __construct( $plugin_name, $version, $node_registry = null ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->node_registry = $node_registry;
	}

	public function enqueue_styles( $hook ) {
        if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
            return;
        }

        global $post;
        if ( 'formflow' !== $post->post_type ) {
            return;
        }

		wp_enqueue_style( $this->plugin_name, FORMFLOW_PLUGIN_URL . 'admin/css/formflow-admin.css', array(), time(), 'all' );
	}

	public function enqueue_scripts( $hook ) {
        if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
            return;
        }

        global $post;
        if ( 'formflow' !== $post->post_type ) {
            return;
        }

        // The core node editor logic
		wp_enqueue_script( $this->plugin_name . '-editor', FORMFLOW_PLUGIN_URL . 'admin/js/formflow-node-editor.js', array( 'jquery' ), time(), true );

        // The preview engine
        wp_enqueue_script( $this->plugin_name . '-preview', FORMFLOW_PLUGIN_URL . 'admin/js/formflow-preview.js', array( 'jquery', $this->plugin_name . '-editor' ), time(), true );

        // Localize script to pass data
        $form_data = get_post_meta( $post->ID, '_formflow_data', true );
        if ( empty( $form_data ) ) {
            $form_data = wp_json_encode( array(
                'nodes' => array(),
                'edges' => array()
            ) );
        }

        wp_localize_script( $this->plugin_name . '-editor', 'formflowEditorData', array(
            'post_id' => $post->ID,
            'form_data' => $form_data,
            'nonce' => wp_create_nonce( 'formflow_save_nonce' ),
            'registered_nodes' => $this->node_registry ? $this->node_registry->get_frontend_nodes() : array()
        ) );
	}

    public function add_plugin_admin_menu() {
        // Add the Details Page
        add_submenu_page(
            'edit.php?post_type=formflow',
            __( 'About FormFlow', 'formflow' ),
            __( 'About / Details', 'formflow' ),
            'manage_options',
            'formflow-details',
            array( $this, 'render_details_page' )
        );
    }

    public function add_action_links( $links ) {
        $details_link = '<a href="' . admin_url( 'edit.php?post_type=formflow&page=formflow-details' ) . '">' . __( 'View Details', 'formflow' ) . '</a>';
        array_unshift( $links, $details_link );
        return $links;
    }

    public function render_details_page() {
        ?>
        <div class="wrap">
            <h1><?php _e( 'FormFlow - Visual Form Builder', 'formflow' ); ?></h1>
            <p><strong><?php _e( 'Author:', 'formflow' ); ?></strong> TheCaptainCook</p>
            <p><?php _e( 'FormFlow is a powerful node-based contact form builder that lets you visually connect input nodes, validation rules, and email actions. Drag, drop, and define the message path—no repetitive coding.', 'formflow' ); ?></p>
            
            <h2><?php _e( 'Features', 'formflow' ); ?></h2>
            <ul style="list-style-type: disc; padding-left: 20px;">
                <li><strong>Visual Node Graph Editor:</strong> Drag and drop your fields on an interactive canvas.</li>
                <li><strong>Live Form Preview:</strong> Instantly see what your form will look like.</li>
                <li><strong>Built-in Spam Protection:</strong> Automatic honeypot fields and keyword heuristics.</li>
                <li><strong>Easy Shortcode Embeds:</strong> Paste your form into any post or page instantly.</li>
            </ul>
            
            <p>
                <a href="<?php echo admin_url( 'post-new.php?post_type=formflow' ); ?>" class="button button-primary"><?php _e( 'Create Your First Form', 'formflow' ); ?></a>
            </p>
        </div>
        <?php
    }

    public function add_editor_meta_box() {
        add_meta_box(
            'formflow_editor_meta_box',
            __( 'Form Builder', 'formflow' ),
            array( $this, 'render_editor_meta_box' ),
            'formflow',
            'normal',
            'high'
        );
        
        add_meta_box(
            'formflow_preview_meta_box',
            __( 'Live Preview', 'formflow' ),
            array( $this, 'render_preview_meta_box' ),
            'formflow',
            'side',
            'high'
        );

        add_meta_box(
            'formflow_shortcode_meta_box',
            __( 'Form Embed Code', 'formflow' ),
            array( $this, 'render_shortcode_meta_box' ),
            'formflow',
            'side',
            'default'
        );
    }

    public function render_preview_meta_box( $post ) {
        echo '<div id="formflow-preview-container" style="background: #fff; max-height: 500px; overflow-y: auto;">';
        echo '<div id="formflow-live-preview"></div>';
        echo '</div>';
    }

    public function render_editor_meta_box( $post ) {
        wp_nonce_field( 'formflow_save_form', 'formflow_meta_box_nonce' );
        require_once FORMFLOW_PLUGIN_DIR . 'admin/partials/formflow-editor-display.php';
    }
    
    public function render_shortcode_meta_box( $post ) {
        $use_custom_id = get_post_meta( $post->ID, '_formflow_use_custom_id', true );
        $custom_id = get_post_meta( $post->ID, '_formflow_custom_id', true );
        
        $display_id = ( $use_custom_id === 'yes' && ! empty( $custom_id ) ) ? $custom_id : $post->ID;
        $shortcode = '[formflow id="' . $display_id . '"]';
        
        echo '<p>' . __( 'Copy this shortcode and paste it into any post, page, or widget to display your form.', 'formflow' ) . '</p>';
        echo '<input type="text" id="formflow_shortcode_display" class="widefat" value="' . esc_attr( $shortcode ) . '" readonly="readonly" onclick="this.select();" style="margin-bottom: 15px;" />';
        
        $checked = ( $use_custom_id === 'yes' ) ? 'checked="checked"' : '';
        $display_style = ( $use_custom_id === 'yes' ) ? 'block' : 'none';
        
        echo '<p><label><input type="checkbox" id="formflow_use_custom_id" name="formflow_use_custom_id" value="yes" ' . $checked . ' /> ' . __( 'Use Custom Shortcode ID', 'formflow' ) . '</label></p>';
        
        echo '<div id="formflow_custom_id_wrapper" style="display: ' . $display_style . ';">';
        echo '<p><label>' . __( 'Custom ID:', 'formflow' ) . '<br />';
        echo '<input type="text" id="formflow_custom_id" name="formflow_custom_id" value="' . esc_attr( $custom_id ) . '" class="widefat" placeholder="e.g. contact-1" /></label></p>';
        echo '</div>';
        
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var defaultId = "<?php echo esc_js( $post->ID ); ?>";
                $('#formflow_use_custom_id').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#formflow_custom_id_wrapper').slideDown();
                        updateShortcodeDisplay();
                    } else {
                        $('#formflow_custom_id_wrapper').slideUp();
                        $('#formflow_shortcode_display').val('[formflow id="' + defaultId + '"]');
                    }
                });
                $('#formflow_custom_id').on('input', function() {
                    updateShortcodeDisplay();
                });
                function updateShortcodeDisplay() {
                    if ($('#formflow_use_custom_id').is(':checked')) {
                        var val = $('#formflow_custom_id').val().trim();
                        var idToUse = val ? val : defaultId;
                        $('#formflow_shortcode_display').val('[formflow id="' + idToUse + '"]');
                    }
                }
            });
        </script>
        <?php
    }

    public function save_form_data( $post_id ) {
        if ( ! isset( $_POST['formflow_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['formflow_meta_box_nonce'], 'formflow_save_form' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( isset( $_POST['formflow_use_custom_id'] ) ) {
            update_post_meta( $post_id, '_formflow_use_custom_id', 'yes' );
            if ( isset( $_POST['formflow_custom_id'] ) ) {
                $custom_id = sanitize_title( $_POST['formflow_custom_id'] );
                if ( ! empty( $custom_id ) ) {
                    $existing = get_posts( array(
                        'post_type'  => 'formflow',
                        'meta_key'   => '_formflow_custom_id',
                        'meta_value' => $custom_id,
                        'exclude'    => array( $post_id ),
                        'post_status'=> 'any',
                        'fields'     => 'ids',
                        'posts_per_page' => 1
                    ) );
                    if ( ! empty( $existing ) ) {
                        $custom_id .= '-' . wp_rand( 100, 999 );
                    }
                }
                update_post_meta( $post_id, '_formflow_custom_id', $custom_id );
            }
        } else {
            update_post_meta( $post_id, '_formflow_use_custom_id', 'no' );
        }

        if ( isset( $_POST['formflow_graph_data'] ) ) {
            $decoded = json_decode( wp_unslash( $_POST['formflow_graph_data'] ), true );
            if ( $decoded ) {
                update_post_meta( $post_id, '_formflow_data', wp_json_encode( $decoded ) );
            }
        }
    }
}
