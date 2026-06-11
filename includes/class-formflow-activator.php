<?php

/**
 * Fired during plugin activation.
 */
class FormFlow_Activator {

	/**
	 * Create custom post type and flush rewrite rules.
	 */
	public static function activate() {
        // Register Custom Post Type for Forms to ensure rewrite rules know about it
        $plugin = new FormFlow();
        $plugin->register_post_types();

        // Flush rewrite rules
		flush_rewrite_rules();
	}

}
