<?php

get_header();

if ( class_exists( 'Timber' ) ) {

    $context = Timber::context();
    $context['homePage'] = new Timber\Post();
    $context['popularSearch'] = foresight_get_keywords_search();
	Timber::render( './view/front-page.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();

