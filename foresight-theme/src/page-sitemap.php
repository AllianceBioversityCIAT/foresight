<?php
/**
 * Template Name: Page - Sitemap
 *
 * @package foresight
 */

get_header();

if (class_exists('Timber')) {

  $context = Timber::context();
  $context['post'] =  new Timber\Post();
  $context['secondaryMenu'] = new TimberMenu('foresight-secondary-menu');
  $context['topMenu'] = new TimberMenu('foresight-top-menu');

	Timber::render('./view/page/sitemap.twig', $context);

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer();