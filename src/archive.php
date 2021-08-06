<?php

get_header();

if ( class_exists( 'Timber' ) ) {

	$context            = Timber::context();
	$context[ 'posts' ] = new Timber\PostQuery();
	Timber::render( './view/archive.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}


get_footer();