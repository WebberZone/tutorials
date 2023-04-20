<?php
/**
 * Plugin Name:       Multiple blocks plugin
 * Plugin URI:        https://webberzone.com/blog/gutenberg-block-development-tutorial/
 * Description:       Example plugin to demonstrate how to create multiple blocks.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            WebberZone
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       multiple-blocks
 * Domain Path:       multiple-blocks
 *
 * @package           wz-tutorial
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/writing-your-first-block-type/
 */
function wz_multiple_blocks_register_blocks() {

	// Register blocks in the format $dir => $render_callback.
	$blocks = array(
		'dynamic' => 'wz_tutorial_dynamic_block_recent_posts', // Dynamic block with a callback.
		'static'  => '', // Static block. Doesn't need a callback.
	);

	foreach ( $blocks as $dir => $render_callback ) {
		$args = array();
		if ( ! empty( $render_callback ) ) {
			$args['render_callback'] = $render_callback;
		}
		register_block_type( __DIR__ . '/build/' . $dir, $args );
	}
}
add_action( 'init', 'wz_multiple_blocks_register_blocks' );

/**
 * Renders the dynamic block on server.
 *
 * @param array $attributes The block attributes.
 *
 * @return string Returns the post content with latest posts added.
 */
function wz_tutorial_dynamic_block_recent_posts( $attributes ) {

	$args = array(
		'posts_per_page'      => $attributes['postsToShow'],
		'post_status'         => 'publish',
		'order'               => $attributes['order'],
		'orderby'             => $attributes['orderBy'],
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);

	$query        = new WP_Query();
	$latest_posts = $query->query( $args );

	$li_html = '';

	foreach ( $latest_posts as $post ) {
		$post_link = esc_url( get_permalink( $post ) );
		$title     = get_the_title( $post );

		if ( ! $title ) {
			$title = __( '(no title)', 'multiple-blocks' );
		}

		$li_html .= '<li>';

		$li_html .= sprintf(
			'<a class="multiple-blocks-recent-posts__post-title" href="%1$s">%2$s</a>',
			esc_url( $post_link ),
			$title
		);

		$li_html .= '</li>';

	}

	$classes = array( 'multiple-blocks-recent-posts' );

	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => implode( ' ', $classes ) ) );

	$heading = $attributes['showHeading'] ? '<h3>' . $attributes['heading'] . '</h3>' : '';

	return sprintf(
		'<div %2$s>%1$s<ul>%3$s</ul></div>',
		$heading,
		$wrapper_attributes,
		$li_html
	);
}
