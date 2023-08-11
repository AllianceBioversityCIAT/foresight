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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/static/images/favicon.png" sizes="32x32" />
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/static/images/favicon-180x180.png" />
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/static/images/favicon-270x270.png" />
		<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
		<link rel="dns-prefetch" href="https://fonts.gstatic.com/">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class('font-open w-full min-w-[320px]'); ?>>
	<noscript>
		<div class="bg-green fixed top-0 left-0 w-full h-full z-50 flex items-center justify-center">
			<div class="flex items-center p-4 m-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
				<svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
					<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
				</svg>
				<span class="sr-only">Warning</span>
				<div>
					<span class="font-medium">Warning:</span> The browser you’re using doesn’t support JavaScript, or has JavaScript turned off.
				</div>
			</div>
		</div>
	</noscript>
		<?php wp_body_open(); ?>
		<div id="page" class="site">
<?php
if ( class_exists( 'Timber' ) ) {

	$context 	= Timber::context();
	$post		= new Timber\Post();

	$context['post'] = $post;
	$context['top_menu'] = new TimberMenu('foresight-top-menu');
	$context['social_menu'] = new TimberMenu('foresight-social-menu');
	$context['platform'] = _PLATFORM;
	Timber::render( './view/header-login.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}