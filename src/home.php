<?php

get_header();

if ( class_exists( 'Timber' ) ) {
	$context = Timber::context();

	if ( $_GET[ 'text' ] ) {
		global $paged;
		$search = $_GET[ 'text' ];

		if ( !isset( $paged ) || !$paged ) {
			$paged = 1;
		}

		$args = array(
			'post_type'           => 'post',
			's'                   => $search,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 'true',
			'order'               => 'DESC',
			'posts_per_page'      => 10,
			'paged'               => $paged
		);

		$found_posts = get_posts( $args );

		$context[ 'posts' ]      = new Timber\PostQuery( $args );
		$context[ 'searchText' ] = $search;

		Timber::render( './view/archives/blog-search.twig', $context );

	} else {
		$populars_posts_args = array(
			'posts_per_page' => 9,
			'meta_key'       => 'post_views',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		);

		$context[ 'posts' ]         = Timber::get_posts();
		$context[ 'popularsPosts' ] = Timber::get_posts( $populars_posts_args );
		Timber::render( './view/archives/blog.twig', $context );
	}

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();
