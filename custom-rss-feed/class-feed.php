<?php
/**
 * Functions to fetch and display the posts in the custom feed.
 *
 * @package WebberZone\Tutorial\Custom_Feed
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Custom Feed class.
 */
class Feed {

	/**
	 * Constructor class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'add_custom_feed' ) );
	}

	/**
	 * Add custom feeds for the overall and daily popular posts.
	 */
	public function add_custom_feed() {

		// Set the slug of the custom feed.
		$feed_slug = 'custom-feed';

		if ( ! empty( $feed_slug ) ) {
			add_feed( $feed_slug, array( $this, 'feed_callback' ) );
		}
	}

	/**
	 * Callback function for add_feed to locate the correct template.
	 */
	public function feed_callback() {
		add_filter( 'pre_option_rss_use_excerpt', '__return_zero' );

		$template = locate_template( 'feed-rss2-popular-posts.php' );

		if ( ! $template ) {
			$template = __DIR__ . '/feed-rss2-custom-post-type.php';
		}

		load_template( $template );
	}
}

new Feed();
