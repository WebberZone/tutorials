<?php
/**
 * Plugin Name:       Example Static block
 * Plugin URI:        https://webberzone.com/blog/gutenberg-block-development-tutorial/
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            WebberZone
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       basic-block
 * Domain Path:       basic-block
 *
 * @package           wz-tutorial
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function wz_tutorial_basic_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'wz_tutorial_basic_block_block_init' );
