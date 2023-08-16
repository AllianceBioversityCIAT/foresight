<?php
/**
 * The template for displaying archive pages
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package foresight_theme.
 */

get_header();

if ( class_exists( 'Timber' ) ) {

	$populars_posts_args = array(
		'posts_per_page' => 9,
		'meta_key'       => 'post_views',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC'
	);

	$context                    = Timber::context();
	$context[ 'posts' ]         = Timber::get_posts();
	$context[ 'popularsPosts' ] = Timber::get_posts( $populars_posts_args );
	Timber::render( './view/archives/blog.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

?>
  <section class="my-16">
    <div class="container relative">
        <?php the_content(); ?>
    </div>
  </section>
<?php

get_footer();
