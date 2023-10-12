<?php
/**
 * Main plugin class.
 *
 * @package wz-tutorials
 */

namespace WebberZone\Tutorials;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the plugin.
 */
class Main {

	/**
	 * Plugin instance.
	 *
	 * @var WZ_Tutorials
	 */
	private static $instance;

	/**
	 * Plugin textdomain.
	 *
	 * @var string
	 */
	protected $plugin_textdomain;

	/**
	 * Plugin constructor.
	 */
	private function __construct() {
		$this->plugin_textdomain = 'wz-tutorials';

		// Load plugin files.
		$this->load_plugin_files();
	}

	/**
	 * Load plugin files.
	 */
	private function load_plugin_files() {
		// Load plugin files.
		require_once WZ_TUTORIALS_PLUGIN_DIR . 'includes/admin/class-bulk-edit.php';
	}

	/**
	 * Get plugin instance.
	 *
	 * @return WZ_Tutorials
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
