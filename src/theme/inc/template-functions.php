<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package foresight
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function foresight_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'foresight_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function foresight_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'foresight_theme_pingback_header' );

/**
 * This foreach will be in charge of registering the fields of the ACF.
 */
foreach ( glob( dirname( __FILE__ ) . '/acf-init/*.php' ) as $filename ) {
	require $filename;
}

/**
 * Function to count views of a post.
 */
function set_post_views() {
	if ( is_single() ) {
		$post_ID = get_the_ID();
		$count = get_post_meta( $post_ID, 'post_views', true );

		if ( $count == '' ) {
			delete_post_meta( $post_ID, 'post_views' );
			add_post_meta( $post_ID, 'post_views', 1 );
		} else {
			update_post_meta( $post_ID, 'post_views', ++$count );
		}
	}
}
add_action( 'wp', 'set_post_views' );

/**
 * Function to get the number of views of a post.
 *
 * @param $post_ID Get The post ID.
 *
 * @return int Return the number of views.
 */
function get_post_views( $post_ID ){
	$count = get_post_meta($post_ID, 'post_views', true);

	if ( $count == '' ){
		delete_post_meta($post_ID, 'post_views');
		add_post_meta($post_ID, 'post_views', 0);
		return 0;
	}

	return $count;
}

/**
 * Add column to wp-admin post listing.
 *
 * @param $defaults Get Gets the list of the items in the post table.
 *
 * @return mixed Returns a new list of items.
 */
function posts_column_views( $defaults ){
	$defaults['post_views'] = __('Views', 'foresight-theme');

	return $defaults;
}
add_filter( 'manage_posts_columns', 'posts_column_views' );

function posts_custom_column_views( $column_name, $id ){
	if ( $column_name === 'post_views' ){
		echo get_post_views( get_the_ID() );
	}
}
add_action( 'manage_posts_custom_column', 'posts_custom_column_views', 5, 2 );


// support column clarisa_id (SDG)
add_action( 'manage_sdg_custom_column', 'foresight_show_sdg_meta_info_in_columns', 10, 3 );
 
function foresight_show_sdg_meta_info_in_columns( $string, $columns, $term_id ) {
    switch ( $columns ) {
        case 'CLARISA_ID' :
            echo esc_html( get_term_meta( $term_id, 'clarisa_id', true ) );
        break;
    }
}

add_filter( 'manage_edit-sdg_columns', 'foresight_add_new_sdg_columns' );
 
function foresight_add_new_sdg_columns( $columns ) {
    $columns['CLARISA_ID'] = __( 'CLARISA ID' );
    return $columns;
}

add_filter( 'manage_edit-sdg_sortable_columns', 'add_sdg_column_sortable' );

function add_sdg_column_sortable( $sortable ){
    $sortable[ 'CLARISA_ID' ] = 'CLARISA ID';
    return $sortable;
}

// support column clarisa_id (IMPACT AREAS)
add_action( 'manage_impact-area_custom_column', 'foresight_show_impact_area_meta_info_in_columns', 10, 3 );
 
function foresight_show_impact_area_meta_info_in_columns( $string, $columns, $term_id ) {
    switch ( $columns ) {
        case 'CLARISA_ID' :
            echo esc_html( get_term_meta( $term_id, 'clarisa_id', true ) );
        break;
    }
}

add_filter( 'manage_edit-impact-area_columns', 'foresight_add_new_impact_area_columns' );
 
function foresight_add_new_impact_area_columns( $columns ) {
    $columns['CLARISA_ID'] = __( 'CLARISA ID' );
    return $columns;
}

add_filter( 'manage_edit-impact-area_sortable_columns', 'add_impact_area_column_sortable' );

function add_impact_area_column_sortable( $sortable ){
    $sortable[ 'CLARISA_ID' ] = 'CLARISA ID';
    return $sortable;
}

// support column clarisa_id (REGIONS)
add_action( 'manage_region_custom_column', 'foresight_show_region_meta_info_in_columns', 10, 3 );
 
function foresight_show_region_meta_info_in_columns( $string, $columns, $term_id ) {
    switch ( $columns ) {
        case 'CLARISA_ID' :
            echo esc_html( get_term_meta( $term_id, 'clarisa_id', true ) );
        break;
    }
}

add_filter( 'manage_edit-region_columns', 'foresight_add_new_region_columns' );
 
function foresight_add_new_region_columns( $columns ) {
    $columns['CLARISA_ID'] = __( 'CLARISA ID' );
    return $columns;
}

add_filter( 'manage_edit-region_sortable_columns', 'add_region_column_sortable' );

function add_region_column_sortable( $sortable ){
    $sortable[ 'CLARISA_ID' ] = 'CLARISA ID';
    return $sortable;
}

/**
 * Search friendly url
 */
function foresight_change_search_url() {
    if ( is_search() && ! empty( $_GET['s']) ) {
        wp_safe_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }
}

add_action( 'template_redirect', 'foresight_change_search_url' );


/**
 * Register Metabox Zotero URL
 */
function foresight_register_publication_meta_box() {
    add_meta_box(
        'zotero-url',
        esc_html__( 'Zotero Link', 'text-domain' ),
        'publication_zotero_url_cb',
        'publication',
        'normal',
        'core'
        );
}
add_action( 'add_meta_boxes', 'foresight_register_publication_meta_box' );
 
function publication_zotero_url_cb($post) {
    // Metabox content
	$metadata = get_post_meta( get_the_ID(), 'zotero-data', true );
	if(!empty($metadata['zoteroUrl'])){
		echo '<a href="'.$metadata['zoteroUrl'].'" target="_blank">'.$metadata['zoteroUrl'].'</a>';
	}
}

//Disabled theme picker
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

//Disabled admin bar
add_filter('show_admin_bar', '__return_false');

/**
 * Change logo for wp-login
 */
function foresight_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            width: auto !important;            
            background-image: url("<?php echo get_template_directory_uri();?>/static/images/foresight-logo.svg") !important;
            background-size: auto !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'foresight_login_logo' );

/* REMOVE WIDGETS DASBOARD */
function remove_dashboard_meta() {
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal');

	// Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }

	global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action( 'admin_init', 'remove_dashboard_meta' );

/**
 * Change Copyright footer
 */
function copyright_footer_admin () {
    echo 'Copyright © 2022 International Center for Tropical Agriculture - CIAT';
}

add_filter('admin_footer_text', 'copyright_footer_admin');


/**
 * Remove comments page in menu
 */ 
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
	
	remove_menu_page('profile.php');
	$current_user = wp_get_current_user();
	if(in_array('contributor',$current_user->roles)) {
		remove_menu_page('tools.php');
		remove_menu_page('index.php');
	}
});

/**
 * Set default page after login: role contributor
 */
function admin_default_page( $redirect_to, $request, $user ) {
	
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            return $redirect_to;
        } else {
            return '/wp-admin/edit.php';
        }
    } else {
        return $redirect_to;
    }
}
  
add_filter('login_redirect', 'admin_default_page', 10, 3);

//Disabled optional settings
add_action( 'admin_head', function(){
    ob_start(); ?>
    <style>
        #your-profile > h2,
		#application-passwords-section,
		#menu-media,
		#wp-admin-bar-comments,
		.user-rich-editing-wrap,
		.user-syntax-highlighting-wrap,
		.user-comment-shortcuts-wrap,
		.user-admin-bar-front-wrap,
		.user-language-wrap,
        .user-url-wrap,
        .user-description-wrap,
		.user-facebook-wrap,
		.user-instagram-wrap,
		.user-linkedin-wrap,
		.user-myspace-wrap,
		.user-pinterest-wrap,
		.user-soundcloud-wrap,
		.user-tumblr-wrap,
		.user-twitter-wrap,
		.user-youtube-wrap,
		.user-wikipedia-wrap
    	{
            display: none;
        }
    </style>
    <?php ob_end_flush();
});


add_action('add_meta_boxes', 'yoast_is_toast', 99);

function yoast_is_toast(){
    //capability of 'manage_plugins' equals admin, therefore if NOT administrator
    //hide the meta box from all other roles on the following 'post_type' 
    //such as post, page, custom_post_type, etc
    if (!current_user_can('manage_plugins')) {
        remove_meta_box('wpseo_meta', 'post', 'normal');
    }
}

/**
 * Rule for redirect to home page after logout
 */

function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}

add_action('wp_logout','auto_redirect_after_logout');

/**
 * Custom Post Type Publication
 */
add_action( 'init', 'publication_register_post_type' );
function publication_register_post_type() {
	$labels = [
		'name'                     => esc_html__( 'Publications', 'foresight' ),
		'singular_name'            => esc_html__( 'Publication', 'foresight' ),
		'add_new'                  => esc_html__( 'Add New', 'foresight' ),
		'add_new_item'             => esc_html__( 'Add new publication', 'foresight' ),
		'edit_item'                => esc_html__( 'Edit Publication', 'foresight' ),
		'new_item'                 => esc_html__( 'New Publication', 'foresight' ),
		'view_item'                => esc_html__( 'View Publication', 'foresight' ),
		'view_items'               => esc_html__( 'View Publications', 'foresight' ),
		'search_items'             => esc_html__( 'Search Publications', 'foresight' ),
		'not_found'                => esc_html__( 'No publications found', 'foresight' ),
		'not_found_in_trash'       => esc_html__( 'No publications found in Trash', 'foresight' ),
		'parent_item_colon'        => esc_html__( 'Parent Publication:', 'foresight' ),
		'all_items'                => esc_html__( 'All Publications', 'foresight' ),
		'archives'                 => esc_html__( 'Publication Archives', 'foresight' ),
		'attributes'               => esc_html__( 'Publication Attributes', 'foresight' ),
		'insert_into_item'         => esc_html__( 'Insert into publication', 'foresight' ),
		'uploaded_to_this_item'    => esc_html__( 'Uploaded to this publication', 'foresight' ),
		'featured_image'           => esc_html__( 'Featured image', 'foresight' ),
		'set_featured_image'       => esc_html__( 'Set featured image', 'foresight' ),
		'remove_featured_image'    => esc_html__( 'Remove featured image', 'foresight' ),
		'use_featured_image'       => esc_html__( 'Use as featured image', 'foresight' ),
		'menu_name'                => esc_html__( 'Publications', 'foresight' ),
		'filter_items_list'        => esc_html__( 'Filter publications list', 'foresight' ),
		'filter_by_date'           => esc_html__( '', 'foresight' ),
		'items_list_navigation'    => esc_html__( 'Publications list navigation', 'foresight' ),
		'items_list'               => esc_html__( 'Publications list', 'foresight' ),
		'item_published'           => esc_html__( 'Publication published', 'foresight' ),
		'item_published_privately' => esc_html__( 'Publication published privately', 'foresight' ),
		'item_reverted_to_draft'   => esc_html__( 'Publication reverted to draft', 'foresight' ),
		'item_scheduled'           => esc_html__( 'Publication scheduled', 'foresight' ),
		'item_updated'             => esc_html__( 'Publication updated', 'foresight' ),
		'text_domain'              => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'               => esc_html__( 'Publications', 'foresight' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'hierarchical'        => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'query_var'           => true,
		'can_export'          => true,
		'delete_with_user'    => false,
		'has_archive'         => true,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'menu_icon'            => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj48c3ZnIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHZpZXdCb3g9IjAgMCAxOCAxOCIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxuczpzZXJpZj0iaHR0cDovL3d3dy5zZXJpZi5jb20vIiBzdHlsZT0iZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjI7Ij48cGF0aCBkPSJNNC4zNjEsMy40N2wwLjA0NiwyLjQ5OGw1LjQ4OCwtMC4wMDdsLTUuNjMxLDYuNTY5Yy0wLjY2NywwLjkxNyAtMC4xMDQsMi4wMDggMC45MjYsMi4wNTNsOC42NTgsMC4wMTdsLTAuMDE0LC0yLjUwNGwtNS45MDksLTAuMDJsNS43NSwtNi43MzJjMC41NTksLTAuOTc2IC0wLjIwOCwtMS44NzYgLTAuOTc4LC0xLjg3NWMtMS42MTYsMC4wMDIgLTguMzM2LDAuMDAxIC04LjMzNiwwLjAwMWwtMC45NjQsLTAuMmw0LjY3NywtMi42MzVjMC41NjIsLTAuMzAzIDEuMTQ0LC0wLjI5IDEuNjczLC0wLjAwNmw2LjI4LDMuNDk2YzAuNTI3LDAuNDI1IDAuNzkyLDAuNzUyIDAuODUxLDEuNDg1bDAuMDIxLDcuMzE4Yy0wLjE5LDAuNDI3IC0wLjQ4OCwwLjc5NiAtMC45MzYsMS4wODFsLTYuMjA2LDMuNDAyYy0wLjYwNSwwLjMwOCAtMS4xOCwwLjI5OSAtMS43ODQsLTAuMDM3bC02LjE2NiwtMy40MzJjLTAuNTIzLC0wLjI5IC0wLjgyMywtMC43MyAtMC44NzQsLTEuMzM3bDAuMDA3LC03LjEzN2MwLjAzLC0wLjU1OSAwLjI1OSwtMS4wMDkgMC43NjQsLTEuMzI0bDEuNjkzLC0wLjg3NGwwLjk2NCwwLjJaIiBzdHlsZT0iZmlsbDojZjAwOyIvPjwvc3ZnPg==',
		'menu_position'       => 5,
		'capabilities' => array(
			'edit_post' => 'edit_publication',
			'edit_posts' => 'edit_publications',
			'edit_others_posts' => 'edit_other_publications',
			'publish_posts' => 'publish_publications',
			'read_post' => 'read_publication',
			'read_private_posts' => 'read_private_publications',
			'delete_post' => 'delete_publication'
		),
		'map_meta_cap'        => true,
		'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'author'],
		'taxonomies'          => ['post_tag', 'category', 'publish-year', 'product-type', 'agrifood-system', 'approach', 'region', 'sdg', 'impact-area'],
		'rewrite'             => [
			'with_front' => false,
		],
	];

	register_post_type( 'publication', $args );
}


/**
 * Publish Year Taxonomy
 */
add_action( 'init', 'publish_year_register_taxonomy' );
function publish_year_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Publish Years', 'foresight' ),
		'singular_name'              => esc_html__( 'Publish Year', 'foresight' ),
		'menu_name'                  => esc_html__( 'Publish Years', 'foresight' ),
		'search_items'               => esc_html__( 'Search Publish Years', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular Publish Years', 'foresight' ),
		'all_items'                  => esc_html__( 'All Publish Years', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent Publish Year', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent Publish Year', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit Publish Year', 'foresight' ),
		'view_item'                  => esc_html__( 'View Publish Year', 'foresight' ),
		'update_item'                => esc_html__( 'Update Publish Year', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new publish year', 'foresight' ),
		'new_item_name'              => esc_html__( 'New publish year name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate publish years with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove publish years', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used publish years', 'foresight' ),
		'not_found'                  => esc_html__( 'No publish years found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No Publish Years', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by publish year', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Publish years list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'Publish Years list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to publish years', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'Publish Years', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'publish-year', ['post', 'publication'], $args );
}



/**
 * Product Type Taxonomy
 */
add_action( 'init', 'product_type_register_taxonomy' );
function product_type_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Product Types', 'foresight' ),
		'singular_name'              => esc_html__( 'Product Type', 'foresight' ),
		'menu_name'                  => esc_html__( 'Product Types', 'foresight' ),
		'search_items'               => esc_html__( 'Search Product Types', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular Product Types', 'foresight' ),
		'all_items'                  => esc_html__( 'All Product Types', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent Product Type', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent Product Type', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit Product Type', 'foresight' ),
		'view_item'                  => esc_html__( 'View Product Type', 'foresight' ),
		'update_item'                => esc_html__( 'Update Product Type', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new product type', 'foresight' ),
		'new_item_name'              => esc_html__( 'New product type name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate product types with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove product types', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used product types', 'foresight' ),
		'not_found'                  => esc_html__( 'No product types found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No Product Types', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by product type', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Product types list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'Product Types list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to product types', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'Product Types', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'product-type', ['post', 'publication'], $args );
}



/**
 * Agrifood System Taxonomy
 */
add_action( 'init', 'agrifood_systems_register_taxonomy' );
function agrifood_systems_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Agrifood Systems', 'foresight' ),
		'singular_name'              => esc_html__( 'Agrifood System', 'foresight' ),
		'menu_name'                  => esc_html__( 'Agrifood Systems', 'foresight' ),
		'search_items'               => esc_html__( 'Search Agrifood Systems', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular Agrifood Systems', 'foresight' ),
		'all_items'                  => esc_html__( 'All Agrifood Systems', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent Agrifood System', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent Agrifood System', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit Agrifood System', 'foresight' ),
		'view_item'                  => esc_html__( 'View Agrifood System', 'foresight' ),
		'update_item'                => esc_html__( 'Update Agrifood System', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new agrifood system', 'foresight' ),
		'new_item_name'              => esc_html__( 'New agrifood system name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate agrifood systems with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove agrifood systems', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used agrifood systems', 'foresight' ),
		'not_found'                  => esc_html__( 'No agrifood systems found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No Agrifood Systems', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by agrifood system', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Agrifood systems list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'Agrifood Systems list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to agrifood systems', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'Agrifood Systems', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'agrifood-system', ['post', 'publication'], $args );
}



/**
 * Approach Taxonomy
 */
add_action( 'init', 'approaches_register_taxonomy' );
function approaches_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Approaches', 'foresight' ),
		'singular_name'              => esc_html__( 'Approach', 'foresight' ),
		'menu_name'                  => esc_html__( 'Approaches', 'foresight' ),
		'search_items'               => esc_html__( 'Search Approaches', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular Approaches', 'foresight' ),
		'all_items'                  => esc_html__( 'All Approaches', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent Approach', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent Approach', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit Approach', 'foresight' ),
		'view_item'                  => esc_html__( 'View Approach', 'foresight' ),
		'update_item'                => esc_html__( 'Update Approach', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new approach', 'foresight' ),
		'new_item_name'              => esc_html__( 'New approach name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate approaches with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove approaches', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used approaches', 'foresight' ),
		'not_found'                  => esc_html__( 'No approaches found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No Approaches', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by approach', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Approaches list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'Approaches list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to approaches', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'Approaches', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'approach', ['post', 'publication'], $args );
}


/**
 * Region Taxonomy
 */

add_action( 'init', 'regions_register_taxonomy' );
function regions_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Regions', 'foresight' ),
		'singular_name'              => esc_html__( 'Region', 'foresight' ),
		'menu_name'                  => esc_html__( 'Regions', 'foresight' ),
		'search_items'               => esc_html__( 'Search Regions', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular Regions', 'foresight' ),
		'all_items'                  => esc_html__( 'All Regions', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent Region', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent Region', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit Region', 'foresight' ),
		'view_item'                  => esc_html__( 'View Region', 'foresight' ),
		'update_item'                => esc_html__( 'Update Region', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new region', 'foresight' ),
		'new_item_name'              => esc_html__( 'New region name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate regions with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove regions', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used regions', 'foresight' ),
		'not_found'                  => esc_html__( 'No regions found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No Regions', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by region', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Regions list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'Regions list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to regions', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'Regions', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'region', ['post', 'publication'], $args );
}


/**
 * SDG Taxonomy
 */
add_action( 'init', 'sdg_register_taxonomy' );
function sdg_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'SDGs', 'foresight' ),
		'singular_name'              => esc_html__( 'SDG', 'foresight' ),
		'menu_name'                  => esc_html__( 'SDGs', 'foresight' ),
		'search_items'               => esc_html__( 'Search SDGs', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular SDGs', 'foresight' ),
		'all_items'                  => esc_html__( 'All SDGs', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent SDG', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent SDG', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit SDG', 'foresight' ),
		'view_item'                  => esc_html__( 'View SDG', 'foresight' ),
		'update_item'                => esc_html__( 'Update SDG', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new SDG', 'foresight' ),
		'new_item_name'              => esc_html__( 'New SDG name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate SDG with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove SDGs', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used SDGs', 'foresight' ),
		'not_found'                  => esc_html__( 'No SDGs found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No SDGs', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by SDG', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Sdgs list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'SDGs list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to SDGs', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'SDGs', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => false,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => true,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => true,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'sdg', ['post', 'publication'], $args );
}


/**
 * Impact Area Taxonomy
 */
add_action( 'init', 'impact_areas_register_taxonomy' );
function impact_areas_register_taxonomy() {
	$labels = [
		'name'                       => esc_html__( 'Impact Areas', 'foresight' ),
		'singular_name'              => esc_html__( 'Impact Area', 'foresight' ),
		'menu_name'                  => esc_html__( 'Impact Areas', 'foresight' ),
		'search_items'               => esc_html__( 'Search Impact Areas', 'foresight' ),
		'popular_items'              => esc_html__( 'Popular Impact Areas', 'foresight' ),
		'all_items'                  => esc_html__( 'All Impact Areas', 'foresight' ),
		'parent_item'                => esc_html__( 'Parent Impact Area', 'foresight' ),
		'parent_item_colon'          => esc_html__( 'Parent Impact Area', 'foresight' ),
		'edit_item'                  => esc_html__( 'Edit Impact Area', 'foresight' ),
		'view_item'                  => esc_html__( 'View Impact Area', 'foresight' ),
		'update_item'                => esc_html__( 'Update Impact Area', 'foresight' ),
		'add_new_item'               => esc_html__( 'Add new impact area', 'foresight' ),
		'new_item_name'              => esc_html__( 'New impact area name', 'foresight' ),
		'separate_items_with_commas' => esc_html__( 'Separate impact areas with commas', 'foresight' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove impact areas', 'foresight' ),
		'choose_from_most_used'      => esc_html__( 'Choose most used impact areas', 'foresight' ),
		'not_found'                  => esc_html__( 'No impact areas found', 'foresight' ),
		'no_terms'                   => esc_html__( 'No Impact Areas', 'foresight' ),
		'filter_by_item'             => esc_html__( 'Filter by impact area', 'foresight' ),
		'items_list_navigation'      => esc_html__( 'Impact areas list pagination', 'foresight' ),
		'items_list'                 => esc_html__( 'Impact Areas list', 'foresight' ),
		'most_used'                  => esc_html__( 'Most Used', 'foresight' ),
		'back_to_items'              => esc_html__( 'Back to impact areas', 'foresight' ),
		'text_domain'                => esc_html__( 'foresight', 'foresight' ),
	];
	$args = [
		'label'              => esc_html__( 'Impact Areas', 'foresight' ),
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'meta_box_cb'        => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false,
		'query_var'          => true,
		'sort'               => false,
		'rest_base'          => '',
		'rewrite'            => [
			'with_front'   => false,
			'hierarchical' => false,
		],
	];
	register_taxonomy( 'impact-area', ['post', 'publication'], $args );
}