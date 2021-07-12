<?php
/**
 * Social Menu.
 *
 * @package foresight_theme
 */

if ( ! function_exists( 'foresight_social_icons' ) ) :

	/**
	 * Display social links in footer.
	 *
	 * @package foresight_theme
	 */
	function foresight_social_icons( $aditional_id = '', $adittional_class = '' ) {
		if ( has_nav_menu( 'foresight-social-menu' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'foresight-social-menu',
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

