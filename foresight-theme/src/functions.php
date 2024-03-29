<?php
require_once __DIR__ . '/vendor/autoload.php';
$timber = new Timber\Timber();
/**
 * foresight functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 * @package foresight
 */

if ( !defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$theme_version = wp_get_theme()->get( 'Version' );
	define( '_S_VERSION', $theme_version );
}

if ( !defined( '_PLATFORM' ) ) {
	// Platform desktop/mobile.
	define( '_PLATFORM', ( wp_is_mobile() ) ? 'mobile' : 'desktop' );
}

/**
 * Gets the global variables to work on the theme.
 */
require get_template_directory() . '/theme/inc/constants.php';

if ( !function_exists( 'foresight_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function foresight_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on cafeto, use a find and replace
		 * to change SLUG_THEME to the name of your theme in all the template files.
		 */
		load_theme_textdomain( SLUG_THEME, get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'foresight-top-menu'    => esc_html__( 'Top Menu', SLUG_THEME ),
				'foresight-secondary-menu' => esc_html__( 'Secondary Menu', SLUG_THEME ),
				'foresight-social-menu' => esc_html__( 'Social Menu', SLUG_THEME ),
				'foresight-footer-menu' => esc_html__( 'Footer Menu', SLUG_THEME ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'foresight_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'foresight_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function foresight_theme_content_width() {
	$GLOBALS[ 'content_width' ] = apply_filters( 'foresight_theme_content_width', 640 );
}

add_action( 'after_setup_theme', 'foresight_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function foresight_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', SLUG_THEME ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', SLUG_THEME ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'foresight_theme_widgets_init' );

// (Optional) Hide the ACF admin menu item.
add_filter( 'acf/settings/show_admin', 'acf_settings_show_admin' );
function acf_settings_show_admin( $show_admin ) {
	return true;
}

/**
 * Enqueue scripts and styles.
 */
function foresight_theme_scripts() {

	//Styles.
	wp_enqueue_style( 'foresight_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

	// Slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/static/lib/slick-carousel/slick/slick.css', false, _S_VERSION );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/static/lib/slick-carousel/slick/slick-theme.css', false, _S_VERSION );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/static/lib/slick-carousel/slick/slick.min.js', array('jquery'), _S_VERSION, true );
	// Fontawesomwe
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/static/lib/@fortawesome/fontawesome-free/css/all.min.css', false, _S_VERSION );
	// Flowbite
	wp_enqueue_script( 'flowbite', get_template_directory_uri() . '/static/lib/flowbite/dist/flowbite.min.js', array(), _S_VERSION, true );
	//Lazy Sizes.
	wp_enqueue_script( 'foresight_theme-lazysizes-js', get_template_directory_uri() . '/static/lib/lazysizes/lazysizes.min.js', array(), _S_VERSION, true );
	//Js
	wp_enqueue_script( 'foresight_theme-js', get_template_directory_uri() . '/static/js/main.min.js', array('jquery'), _S_VERSION, true );
	wp_add_inline_script( 'foresight_theme-js', 'ajax_object =' . json_encode( array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) ) );


	$options_page = get_fields( 'theme-general-settings' );

	// Google reCAPTCHA
	if ( $options_page[ 'recaptcha_site_key' ] ) {
		wp_enqueue_script( 'googleRecaptcha', 'https://www.google.com/recaptcha/api.js?render=' . $options_page[ 'recaptcha_site_key' ], 'latest', true );
		wp_localize_script( 'foresight_theme-js', 'googleRecaptcha', array( 'siteKey' => $options_page[ 'recaptcha_site_key' ] ) );
	}
}

add_action( 'wp_enqueue_scripts', 'foresight_theme_scripts' );

/**
 * Disable the emoji's
 */
function disable_unused_tools() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}

add_action( 'init', 'disable_unused_tools' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 *
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 *
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}

/**
 * Remove unused metadata
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

/**
 * Remove recent comments wp_head CSS
 */
function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ], 'recent_comments_style' ) );
}

add_action( 'widgets_init', 'remove_recent_comments_style' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme/inc/template-functions.php';

/**
 * Functions related to API REST in WordPress
 */
require get_template_directory() . '/theme/inc/template-functions-api.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme/inc/customizer/customizer.php';

/**
 * Load Social Navigation.
 */
require get_template_directory() . '/theme/menu/social-menu.php';

/**
 * Custom gutenberg blocks.
 */
require get_theme_file_path('/theme/inc/custom-blocks/custom-blocks.php');

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/theme/inc/jetpack.php';
}

if ( !function_exists( 'foresight_save_keywords_search' ) ) :
	function foresight_save_keywords_search( $query_object ) {
		if ( $query_object->is_search() ) {
			$transient_data = get_transient( 'foresight_popular_search' );
			$array_data     = ( $transient_data ) ? unserialize( $transient_data ) : array();

			$keywords = strtolower( $query_object->query[ 's' ] );
			$keywords = preg_replace( '/[^A-Za-z0-9\s]/', '', $keywords );
			$keywords = explode( ' ', $keywords );

			foreach ( $keywords as $keyword ) {
				if ( strlen( $keyword ) > 3 && !in_array( $keyword, $array_data ) ) {
					$array_data[] = strtolower( $keyword );
				}
			}

			$transient_data = serialize( $array_data );
			set_transient( 'foresight_popular_search', $transient_data, 30 * DAY_IN_SECONDS );
		}
	}
endif;

if ( !function_exists( 'foresight_get_keywords_search' ) ) :
	function foresight_get_keywords_search() {
		$transient_data = get_transient( 'foresight_popular_search' );
		return unserialize( $transient_data );
	}
endif;

add_action( 'parse_query', 'foresight_save_keywords_search' );

/**
 * Add option page
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'parent_slug'	  => 'options-general.php',
		'page_title'      => 'Theme Settings',
		'menu_title'      => 'Foresight Options',
		'menu_slug'       => 'theme-general-settings',
		'capability'      => 'manage_options',
		'redirect'        => false,
		'update_button'   => 'Save options',
		'updated_message' => 'Options saved',
		'post_id'         => 'theme-general-settings',
	) );

}


/**
 * Popular search
 */
if ( !function_exists( 'foresight_popular_searches' ) ) :

	function foresight_popular_searches( $display, $searches ) {
		$output = '<option value="">Select keyword</option>';

		if ( $searches ){
			foreach ( $searches as $key => $value ) {
				if( !empty($value[ 'term' ]) ){
					$output .= '<option value="' . $value[ 'term' ] . '">'.$value[ 'term' ].'</option>';
				}
			}
		} else {
			$output .= '<option value="">Nothing yet</option>';
		}
		return $output;
	}

	add_filter( 'sm_list_popular_searches_display', 'foresight_popular_searches', 10, 2 );

endif;


/**
 * Fixed wp_remote_get
 * https://gist.github.com/timersys/4480bccf64a1147abb3d
 * SSL routines:CONNECT_CR_SRVR_HELLO:sslv3 alert handshake failure
 */
function foresight_display_api_curl( &$handle, $args, $url ) {

	curl_setopt($handle, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
	curl_setopt($handle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
	curl_getinfo($handle);
	return $handle;

}

add_action( 'http_api_curl', 'foresight_display_api_curl', 10, 3 );
