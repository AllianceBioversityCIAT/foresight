<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foresight_theme
 */

if ( class_exists( 'Timber' ) ) {

	$context = Timber::context();
	$context['footer_menu'] = new TimberMenu('foresight-footer-menu');
	$context['social_menu'] = new TimberMenu('foresight-social-menu');
	$options_page =	get_fields( 'theme-general-settings' );

	Timber::render( './view/footer.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
