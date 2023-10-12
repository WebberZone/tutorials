<?php
/**
 * Plugin Name:       WebberZone Tutorials Plugin
 * Plugin URI:        https://webberzone.com/blog/
 * Description:       This plugin contains code from the various WebberZone tutorials.
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Author:            Ajay D'Souza
 * Author URI:        https://webberzone.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wz-tutorials
 * Domain Path:       /languages
 * Update URI:        https://webberzone.com/blog/
 *
 * @package           wz-tutorials
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register plugin constants.
define( 'WZ_TUTORIALS_VERSION', '1.0.0' );
define( 'WZ_TUTORIALS_FILE', __FILE__ );
define( 'WZ_TUTORIALS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WZ_TUTORIALS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WZ_TUTORIALS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );


// Load the plugin class.
require_once WZ_TUTORIALS_PLUGIN_DIR . 'includes/class-main.php';

/**
 * The main function responsible for returning the one true WebberZone Snippetz instance to functions everywhere.
 */
function load_wz_tutorials() {
	\WebberZone\Tutorials\Main::get_instance();
}
add_action( 'plugins_loaded', 'load_wz_tutorials' );
