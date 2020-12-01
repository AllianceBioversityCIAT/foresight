<?php
/**
 * Cafeto Home header.
 *
 * @package Cafeto_theme.
 */

/**
 * Add customization support for the home section of the theme.
 *
 * @param $wp_customize Theme Customizer object.
 */
function register_customizer_section_header( $wp_customize ) {
	$custom_panel_home_header = 'custom-panel-home-header';
	$custom_section_home_nav = 'custom-section-home-nav';

	customize_add_panel( $wp_customize, $custom_panel_home_header, '[Theme] Panel Home Header' );

	customize_add_section( $wp_customize, $custom_panel_home_header, $custom_section_home_nav, 'Logo and Bottom' );

	//Logo.
	customize_add_setting( $wp_customize, 'theme_nav_logo', '#theme-nav-logo' );

	customize_add_control_image( $wp_customize, $custom_section_home_nav, 'theme_nav_logo',
		'theme_nav_logo_control', 'Theme Logo.'  );
}

add_action('customize_register', 'register_customizer_section_header');
