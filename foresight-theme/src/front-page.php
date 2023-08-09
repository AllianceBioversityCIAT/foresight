<?php
get_header();

if ( class_exists( 'Timber' ) ) {

    $context = Timber::context();
	$context['frontPage'] = new Timber\Post();
    $context['popularSearch'] = foresight_get_keywords_search();
    $featured_post_args = array(
		'posts_per_page' => 4,
	);
	$context['featuredPost'] = new Timber\PostQuery($featured_post_args);
	Timber::render( './view/front-page.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();

