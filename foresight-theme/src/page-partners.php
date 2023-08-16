<?php
/**
 * Template Name: Page - Partners
 *
 * @package foresight
 */

get_header();

if (class_exists('Timber')) {

	$context = Timber::context();
	$context['post'] =  new Timber\Post();

	Timber::render('./view/page/partners.twig', $context);
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