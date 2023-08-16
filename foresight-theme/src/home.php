<?php

get_header();

if (class_exists('Timber')) {

	$context = Timber::context();
	$context['post'] =  new Timber\Post();

	Timber::render('./view/page.twig', $context);
} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();
