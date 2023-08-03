<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foresight
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/static/images/favicon.png" sizes="32x32" />
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/static/images/favicon-180x180.png" />
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/static/images/favicon-270x270.png" />

		<?php wp_head(); ?>
	</head>

	<body>
		<?php wp_body_open(); ?>
		<div id="page" class="site">
			<?php
if ( class_exists( 'Timber' ) ) {

	$context = Timber::context();
	$context['menu'] = new TimberMenu('foresight-top-menu');
	$context['platform'] = _PLATFORM;
	Timber::render( './view/header.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}