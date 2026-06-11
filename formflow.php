<?php
/**
 * Plugin Name:       FormFlow
 * Plugin URI:        https://example.com/formflow
 * Description:       A powerful, node-based visual contact form builder. Drag and drop your form fields, connect them logically, and embed them anywhere with live preview and built-in spam protection.
 * Version:           1.0.0
 * Author:            TheCaptainCook
 * License:           GPL-2.0+
 * Text Domain:       formflow
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'for_fsrealfree' ) ) {
    for_fsrealfree()->set_basename( true, __FILE__ );
} else {
    /**
     * DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE
     * `function_exists` CALL ABOVE TO PROPERLY WORK.
     */
    if ( ! function_exists( 'for_fsrealfree' ) ) {
        // Create a helper function for easy SDK access.
        function for_fsrealfree() {
            global $for_fsrealfree;

            if ( ! isset( $for_fsrealfree ) ) {
                // Activate multisite network integration.
                if ( ! defined( 'WP_FS__PRODUCT_31450_MULTISITE' ) ) {
                    define( 'WP_FS__PRODUCT_31450_MULTISITE', true );
                }

                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';

                $for_fsrealfree = fs_dynamic_init( array(
                    'id'                  => '31450',
                    'slug'                => 'formflow',
                    'type'                => 'plugin',
                    'public_key'          => 'pk_9b48323f30cd9360d659718ca6058',
                    'is_premium'          => true,
                    // If your plugin is a serviceware, set this option to false.
                    'has_premium_version' => true,
                    'has_addons'          => false,
                    'has_paid_plans'      => true,
                    'is_org_compliant'    => true,
                    // Automatically removed in the free version. If you're not using the
                    // auto-generated free version, delete this line before uploading to wp.org.
                    'wp_org_gatekeeper'   => 'OA7#BoRiBNqdf52FvzEf!!074aRLPs8fspif$7K1#4u4Csys1fQlCecVcUTOs2mcpeVHi#C2j9d09fOTvbC0HloPT7fFee5WdS3G',
                    'trial'               => array(
                        'days'               => 7,
                        'is_require_payment' => true,
                    ),
                    'menu'                => array(
                        'slug'           => 'edit.php?post_type=formflow',
                        'network'        => true,
                    ),
                ) );
            }

            return $for_fsrealfree;
        }

        // Init Freemius.
        for_fsrealfree();
        // Signal that SDK was initiated.
        do_action( 'for_fsrealfree_loaded' );
    }

    define( 'FORMFLOW_VERSION', '1.0.0' );
    define( 'FORMFLOW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    define( 'FORMFLOW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    /**
     * The code that runs during plugin activation.
     */
    function activate_formflow() {
        require_once FORMFLOW_PLUGIN_DIR . 'includes/class-formflow-activator.php';
        FormFlow_Activator::activate();
    }

    /**
     * The code that runs during plugin deactivation.
     */
    function deactivate_formflow() {
        require_once FORMFLOW_PLUGIN_DIR . 'includes/class-formflow-deactivator.php';
        FormFlow_Deactivator::deactivate();
    }

    register_activation_hook( __FILE__, 'activate_formflow' );
    register_deactivation_hook( __FILE__, 'deactivate_formflow' );

    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require FORMFLOW_PLUGIN_DIR . 'includes/class-formflow.php';

    /**
     * Begins execution of the plugin.
     */
    function run_formflow() {
        $plugin = new FormFlow();
        $plugin->run();
    }
    run_formflow();
}
