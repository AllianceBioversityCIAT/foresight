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
	$context['footerMenu'] = new TimberMenu('foresight-footer-menu');
	$context['socialMenu'] = new TimberMenu('foresight-social-menu');
	$options_page =	get_fields( 'theme-general-settings' );
	$context['footer_company_image'] = $options_page[ 'footer_company_image' ];
	$context['footerCompanyText'] = $options_page[ 'footer_company_text' ];
	$context['footerTitleNewsletter'] = $options_page[ 'footer_title_newsletter' ];

	Timber::render( './view/footer.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
