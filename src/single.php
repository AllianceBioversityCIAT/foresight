<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package foresight
 */

get_header();

if ( class_exists( 'Timber' ) ) {
	$next_post    = get_next_post();
	$prev_post    = get_previous_post();
	$context = Timber::context();
	$context[ 'post' ] = new Timber\Post();

	if ( is_object( $prev_post ) ) {
		$context[ 'prev_post' ]    = [
			'permalink' => get_permalink( $prev_post->ID ),
			'title'     => $prev_post->post_title,
		];
	}

	if ( is_object( $next_post ) ) {
		$context[ 'next_post' ] = [
			'permalink' => get_permalink( $next_post->ID ),
			'title'     => $next_post->post_title,
		];
	}

	Timber::render( './view/single.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();
