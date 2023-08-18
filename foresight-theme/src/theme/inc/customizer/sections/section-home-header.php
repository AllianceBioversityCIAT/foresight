<?php
/**
 * Foresight site footer.
 *
 * @package foresight_theme.
 */

/**
 * Add customization support for the footer section of the theme.
 *
 * @param $wp_customize Theme Customizer object.
 */
function register_customizer_section_footer( $wp_customize ) {

	$custom_section_home_nav = 'custom-section-home-nav';
	customize_add_section( $wp_customize, null, $custom_section_home_nav, 'Footer' );

	customize_add_setting( $wp_customize, 'theme_footer_logo', '#theme-footer-logo' );
	customize_add_setting( $wp_customize, 'theme_footer_about', '#theme-footer-text' );
	customize_add_setting( $wp_customize, 'theme_footer_newsletter_link', '#theme-footer-newsletter-link' );
	customize_add_setting( $wp_customize, 'theme_footer_newsletter_label', '#theme-footer-newsletter-label' );
	customize_add_setting( $wp_customize, 'theme_footer_newsletter_button', '#theme-footer-newsletter-button' );

	customize_add_control_image( $wp_customize, $custom_section_home_nav, 'theme_footer_logo',
		'theme_nav_logo_control', 'Footer Logo'  );
	
	customize_add_control_textarea( $wp_customize, $custom_section_home_nav, 'theme_footer_about',
		'theme_nav_description_control', 'About Foresight'  );

	customize_add_control_text( $wp_customize, $custom_section_home_nav, 'theme_footer_newsletter_link',
		'theme_nav_newsletter_link_control', 'Newsletter Link'  );

	customize_add_control_text( $wp_customize, $custom_section_home_nav, 'theme_footer_newsletter_label',
		'theme_nav_newsletter_label_control', 'Newsletter Label'  );

	customize_add_control_text( $wp_customize, $custom_section_home_nav, 'theme_footer_newsletter_button',
		'theme_nav_newsletter_button_control', 'Newsletter Button'  );
}

add_action('customize_register', 'register_customizer_section_footer');
