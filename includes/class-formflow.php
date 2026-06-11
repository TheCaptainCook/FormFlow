<?php

/**
 * The core plugin class.
 */
class FormFlow {

	protected $plugin_name;
	protected $version;
	protected $node_registry;

	public function __construct() {
		$this->version = FORMFLOW_VERSION;
		$this->plugin_name = 'formflow';

		$this->load_dependencies();

		$this->node_registry = new FormFlow_Node_Registry();

		$this->define_admin_hooks();
		$this->define_public_hooks();
        add_action( 'init', array( $this, 'register_post_types' ) );
	}

    public function register_post_types() {
        $labels = array(
            'name'               => _x( 'Forms', 'post type general name', 'formflow' ),
            'singular_name'      => _x( 'Form', 'post type singular name', 'formflow' ),
            'menu_name'          => _x( 'FormFlow', 'admin menu', 'formflow' ),
            'name_admin_bar'     => _x( 'Form', 'add new on admin bar', 'formflow' ),
            'add_new'            => _x( 'Add New', 'form', 'formflow' ),
            'add_new_item'       => __( 'Add New Form', 'formflow' ),
            'new_item'           => __( 'New Form', 'formflow' ),
            'edit_item'          => __( 'Edit Form', 'formflow' ),
            'view_item'          => __( 'View Form', 'formflow' ),
            'all_items'          => __( 'All Forms', 'formflow' ),
            'search_items'       => __( 'Search Forms', 'formflow' ),
            'not_found'          => __( 'No forms found.', 'formflow' ),
            'not_found_in_trash' => __( 'No forms found in Trash.', 'formflow' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'formflow' ),
            'public'             => false, // Only for admin
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'formflow' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-feedback',
            'supports'           => array( 'title' ) // Custom editor will replace the standard editor
        );

        register_post_type( 'formflow', $args );
    }

	private function load_dependencies() {
		require_once FORMFLOW_PLUGIN_DIR . 'includes/class-formflow-node-registry.php';
		require_once FORMFLOW_PLUGIN_DIR . 'admin/class-formflow-admin.php';
		require_once FORMFLOW_PLUGIN_DIR . 'public/class-formflow-public.php';
		require_once FORMFLOW_PLUGIN_DIR . 'includes/modules/spam-protection/class-spam-engine.php';
	}

	private function define_admin_hooks() {
		$plugin_admin = new FormFlow_Admin( $this->get_plugin_name(), $this->get_version(), $this->node_registry );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
		add_action( 'add_meta_boxes', array( $plugin_admin, 'add_editor_meta_box' ) );
        add_action( 'save_post', array( $plugin_admin, 'save_form_data' ) );
        add_action( 'admin_menu', array( $plugin_admin, 'add_plugin_admin_menu' ) );
        add_filter( 'plugin_action_links_' . plugin_basename( FORMFLOW_PLUGIN_DIR . 'formflow.php' ), array( $plugin_admin, 'add_action_links' ) );
	}

	private function define_public_hooks() {
		$plugin_public = new FormFlow_Public( $this->get_plugin_name(), $this->get_version() );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );
        add_shortcode( 'formflow', array( $plugin_public, 'render_shortcode' ) );
        add_action( 'wp_ajax_formflow_submit', array( $plugin_public, 'handle_form_submission' ) );
        add_action( 'wp_ajax_nopriv_formflow_submit', array( $plugin_public, 'handle_form_submission' ) );
	}

	public function run() {
		// Execution handled by actions and filters.
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_version() {
		return $this->version;
	}
}
