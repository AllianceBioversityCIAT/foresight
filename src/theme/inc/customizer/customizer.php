<?php
/**
 * Cafeto Seed Theme Customizer.
 *
 * @package foresight_theme.
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'theme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Section customizer default variables.
 */
require get_template_directory().'/theme/inc/customizer/default-variables.php';

/**
 * Get the functions for the customizer fields.
 */
require get_template_directory().'/theme/inc/customizer/customizer-functions.php';

/**
 * Register the Section Customizer in home page.
 */
foreach ( glob( dirname( __FILE__ ). '/sections/*.php' ) as $filename ) {
	require $filename;
}

/**
 * This function is valid if the field to be customized is filled in if it is not filled in by default.
 *
 * @param $name string Gets the identifier of the field to be searched.
 *
 * @return mixed Returns the description of the field found.
 */
function customize_theme_mod( $name ) {

	if ( get_theme_mod( $name ) == '' ) {

		return customize_default_variables( $name );

	}

	return get_theme_mod( $name, customize_default_variables( $name ) );
}
