<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package foresight
 */

get_header();

if ( class_exists( 'Timber' ) ) {
	global $wp;
	$category       = get_the_terms( get_the_ID(), 'category' );
	$url_components = add_query_arg( $wp->query_vars, home_url( $wp->request ) );
	parse_str( $url_components, $params );
	$category_name = $params[ 'category_name' ];

	if ( !$params[ 'category_name' ] ) {
		$category_name = $category[ 0 ]->slug;
	}

	$args_related_posts = array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'post__not_in'   => [
			get_the_ID(),
		],
		'tax_query'      => [
			[
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $category_name,
			],
		],
	);

	$context                   = Timber::context();
	$context[ 'post' ]         = new Timber\Post();
	$context[ 'relatedPosts' ] = Timber::get_posts( $args_related_posts );

	Timber::render( './view/single/single.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();
