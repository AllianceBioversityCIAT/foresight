<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cafeto_theme
 */

if ( class_exists( 'Timber' ) ) {

	$context = Timber::context();

	Timber::render( './view/footer.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
