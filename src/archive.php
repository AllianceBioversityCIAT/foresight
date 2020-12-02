<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cafeto
 */

get_header();

if ( class_exists( 'Timber' ) ) {

	$context = Timber::context();
	$site = new TimberSite();
	$args = array(
		'post_type' => 'post',
		'found_posts' => 4,
		'posts_per_page' => 4,
	);
	$context['s'] = get_search_query();
	$context['lastPosts'] = new Timber\PostQuery($args);

	$context['posts'] = new Timber\PostQuery();

	Timber::render( './view/search.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}


get_footer();
