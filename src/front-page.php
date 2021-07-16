<?php

get_header();

if ( class_exists( 'Timber' ) ) {

    $context = Timber::context();
    $context['homePage'] = new Timber\Post();
	Timber::render( './view/front-page.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();

