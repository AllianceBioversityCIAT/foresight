<?php

get_header();

if ( class_exists( 'Timber' ) ) {

	$context = Timber::context();
	global $paged;
	if ( !isset( $paged ) || !$paged ) {
		$paged = 1;
	}
	$postPerPage = get_option( 'posts_per_page' );
	$args        = array(
		'post_type' => 'post',
		'paged'     => $paged,
	);

	$context[ 'posts' ] = new Timber\PostQuery( $args );

	$context[ 'post' ]        = new Timber\Post();
	$context[ 'contentBlog' ] = [
		'imageHeader'     => get_stylesheet_directory_uri() . '/static/images/foresight-background-blog.jpg',
		'imageTest'       => get_stylesheet_directory_uri() . '/static/images/foresight-background-blog.jpg',
		'termsBlog'       => get_terms( array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
		) ),
	];

	Timber::render( './view/archive-blog.twig', $context );
} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();