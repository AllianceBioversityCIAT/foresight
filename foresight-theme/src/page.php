<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foresight
 */

get_header();

if (class_exists('Timber')) {

	$context = Timber::context();
	$context['post'] =  new Timber\Post();

	Timber::render('./view/page.twig', $context);
} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();
