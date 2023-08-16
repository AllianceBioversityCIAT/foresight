<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package foresight
 */

get_header();

if ( class_exists( 'Timber' ) ) {

	$context			= Timber::context();
	$context[ 'post' ]	= new Timber\Post();

	Timber::render( './view/single/single.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();
