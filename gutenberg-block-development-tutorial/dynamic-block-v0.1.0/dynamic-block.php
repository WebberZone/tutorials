<?php
/**
 * Plugin Name:       Example Dynamic Block
 * Plugin URI:        https://webberzone.com/
 * Description:       Example Dynamic Block
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            webberzone, ajay
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dynamic-block
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
function wz_tutorial_dynamic_block_block_init() {
	register_block_type(
		__DIR__ . '/build',
		array(
			'render_callback' => 'wz_tutorial_dynamic_block_recent_posts',
		)
	);
}
add_action( 'init', 'wz_tutorial_dynamic_block_block_init' );

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
			$title = __( '(no title)', 'dynamic-block' );
		}

		$li_html .= '<li>';

		$li_html .= sprintf(
			'<a class="dynamic-block-recent-posts__post-title" href="%1$s">%2$s</a>',
			esc_url( $post_link ),
			$title
		);

		$li_html .= '</li>';

	}

	$classes = array( 'dynamic-block-recent-posts' );

	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => implode( ' ', $classes ) ) );

	$heading = $attributes['showHeading'] ? '<h3>' . $attributes['heading'] . '</h3>' : '';

	return sprintf(
		'<div %2$s>%1$s<ul>%3$s</ul></div>',
		$heading,
		$wrapper_attributes,
		$li_html
	);
}
