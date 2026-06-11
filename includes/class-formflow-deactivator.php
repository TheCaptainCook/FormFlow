<?php

/**
 * Fired during plugin deactivation.
 */
class FormFlow_Deactivator {

	/**
	 * Flush rewrite rules upon deactivation.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

}
