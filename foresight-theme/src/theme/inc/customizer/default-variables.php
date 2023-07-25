<?php
/**
 * Customizer Default Variables.
 *
 * @package foresight_theme.
 */

/**
 * This function builds an array with all the default variables for the customizer.
 *
 * @param $option Gets the identifier for the variables.
 *
 * @return mixed Returns the description of the field found.
 */
function customize_default_variables( $option ) {
	$df = [
		'theme_nav_logo' => get_stylesheet_directory_uri() . '/static/images/foresight_logo.png',
	];

	// Return default option if not empty
	if ( !empty( $df[ $option ] ) ) {
		return $df[ $option ];
	}
}
