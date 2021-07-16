<?php

get_header();

if ( class_exists( 'Timber' ) ) {

    $post = new Timber\Post();
    $context = Timber::context();
    $context['homePage'] = $post;
	Timber::render( './view/front-page.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();

