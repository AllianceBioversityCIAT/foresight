<?php
/**
 * Social Menu.
 *
 * @package Cafeto_theme
 */

if ( ! function_exists( 'cafeto_social_icons' ) ) :

	/**
	 * Display social links in footer.
	 *
	 * @package Cafeto_theme
	 */
	function cafeto_social_icons( $aditional_id = '', $adittional_class = '' ) {
		if ( has_nav_menu( 'cafeto-social-menu' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'cafeto-social-menu',
					'container'       => 'nav',
					'container_id'    => 'social',
					'container_class' => 'social-icons',
					'menu_id'         => 'menu-social-items',
					'menu_class'      => 'list-inline social-list',
					'depth'           => 1,
					'fallback_cb'     => '',
					'link_before'     => '<i id="'.$aditional_id.'" class="'.$adittional_class.' social_icon fab fa-',
					'link_after'      => '"></i>',
				)
			);
		}
	}
endif;

