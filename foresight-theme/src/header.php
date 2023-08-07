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

		<?php wp_head(); ?>
	</head>

	<body class="font-open w-full min-w-[320px]">
		<?php wp_body_open(); ?>
		<div id="page" class="site">
<?php
if ( class_exists( 'Timber' ) ) {

	$context 	= Timber::context();
	$post		= new Timber\Post();

	if (isset($post->hero_image) && strlen($post->hero_image)){
		$post->hero_image = new Timber\Image($post->hero_image);
	}else{
		$post->hero_image = get_template_directory_uri().'/static/images/hero-image.jpeg';
	}

	$context['post'] = $post;
	$context['top_menu'] = new TimberMenu('foresight-top-menu');
	$context['social_menu'] = new TimberMenu('foresight-social-menu');
	$context['platform'] = _PLATFORM;
	Timber::render( './view/header.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}