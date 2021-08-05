<?php
/**
 * Template Name: Page - Contact
 *
 * @package foresight
 */

get_header();

if ( class_exists( 'Timber' ) ) {
	$id_page                 = get_the_ID();
	$context                 = Timber::context();
	$context[ 'post' ]       = new Timber\Post();
	$context[ 'socialMenu' ] = new TimberMenu( 'foresight-social-menu' );


	Timber::render( './view/page/contact.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer( 'secondary' );
