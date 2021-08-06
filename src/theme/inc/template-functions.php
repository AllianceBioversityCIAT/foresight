<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package foresight
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function foresight_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'foresight_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function foresight_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'foresight_theme_pingback_header' );

/**
 * This foreach will be in charge of registering the fields of the ACF.
 */
foreach ( glob( dirname( __FILE__ ) . '/acf-init/*.php' ) as $filename ) {
	require $filename;
}

/**
 * Function to count views of a post.
 */
function set_post_views() {
	if ( is_single() ) {
		$post_ID = get_the_ID();
		$count = get_post_meta( $post_ID, 'post_views', true );

		if ( $count == '' ) {
			delete_post_meta( $post_ID, 'post_views' );
			add_post_meta( $post_ID, 'post_views', 1 );
		} else {
			update_post_meta( $post_ID, 'post_views', ++$count );
		}
	}
}
add_action( 'wp', 'set_post_views' );

/**
 * Function to get the number of views of a post.
 *
 * @param $post_ID Get The post ID.
 *
 * @return int Return the number of views.
 */
function get_post_views( $post_ID ){
	$count = get_post_meta($post_ID, 'post_views', true);

	if ( $count == '' ){
		delete_post_meta($post_ID, 'post_views');
		add_post_meta($post_ID, 'post_views', 0);
		return 0;
	}

	return $count;
}

/**
 * Add column to wp-admin post listing.
 *
 * @param $defaults Get Gets the list of the items in the post table.
 *
 * @return mixed Returns a new list of items.
 */
function posts_column_views( $defaults ){
	$defaults['post_views'] = __('Views', 'foresight-theme');

	return $defaults;
}
add_filter( 'manage_posts_columns', 'posts_column_views' );

function posts_custom_column_views( $column_name, $id ){
	if ( $column_name === 'post_views' ){
		echo get_post_views( get_the_ID() );
	}
}
add_action( 'manage_posts_custom_column', 'posts_custom_column_views', 5, 2 );
