<?php
/**
 * This source code is the confidential, proprietary information of
 * Cafeto Software S.A.S. here in, you may not disclose such Information,
 * and may only use it in accordance with the terms of the license
 * agreement you entered into with Cafeto Software S.A.S.
 * 2021: Cafeto Software S.A.S.
 * Plugin Name:     Algolia Foresight
 * Plugin URI:      https://cafeto.co
 * Description:     Algolia Search service integration
 * Author:          Cafeto Software
 * Author URI:      https://cafeto.co
 * Text Domain:     algolia-foresight
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         algolia-foresight
 */

require_once __DIR__ . '/vendor/autoload.php';
if (! defined('ALGOLIA_APPLICATION_ID')) {
    die('ALGOLIA_APPLICATION_ID is not defined in wp-config.php');
}
if (! defined('ALGOLIA_ADMIN_KEY')) {
    die('ALGOLIA_ADMIN_KEY is not defined in wp-config.php');
}
if (! defined('ALGOLIA_SEARCH_KEY')) {
    die('ALGOLIA_SEARCH_KEY is not defined in wp-config.php');
}
if (! defined('ALGOLIA_INDEX')) {
    die('ALGOLIA_INDEX is not defined in wp-config.php');
}

global $algolia;
$algolia = \Algolia\AlgoliaSearch\SearchClient::create(ALGOLIA_APPLICATION_ID, ALGOLIA_ADMIN_KEY);

require_once __DIR__ . '/wp-cli.php';

/**
 * Serialize Items
 */
function algolia_post_to_record(WP_Post $post) {

	/** Publications */
	if($post->post_type == 'publication'){

		$post_meta 		= get_post_meta($post->ID, 'zotero-data');
		$post_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' )[0];
		$record = [
			'objectID' => implode('#', [ $post->post_type, $post->ID ]),
			'item_type' => ucfirst(preg_replace( '/([a-z0-9])([A-Z])/', "$1 $2", $post_meta[0]['itemType'])),
			'post_type' => $post->post_type,
			'post_title' => $post->post_title,
			'post_date' => $post->post_date,
			'post_date_gmt' => $post->post_date_gmt,
			'post_content' => strip_tags( $post->post_content ),
			'excerpt' => $post->post_excerpt,
			'url' => get_post_permalink( $post->ID ),
			'publication_title' => $post_meta[0]['publicationTitle'],
			'website_title' => $post_meta[0]['websiteTitle'],
			'authors' => get_post_author( $post, $post_meta ),
			'tags' => get_post_tags( $post->ID ),
			'volume' => $post_meta[0]['volume'],
			'pages' => $post_meta[0]['pages'],
			'language' => $post_meta[0]['language'],
			'DOI' => addhttpsDOI($post_meta[0]['DOI']),
			'ISSN' => $post_meta[0]['ISSN'],
			'short_title' => $post_meta[0]['shortTitle'],
			'url' => $post_meta[0]['url'],
			'library_catalog' => $post_meta[0]['libraryCatalog'],
			'extra' => $post_meta[0]['extra'],
			'post_thumb_url' => $post_thumb_url
		];

		if(!empty($post_meta[0]['year'])){
			$record['year'] = (int) $post_meta[0]['year'];
		}

		//Add countries
		if(!empty($record['tags']['region']['lvl1'])){
			foreach ($record['tags']['region']['lvl1'] as $key => $value) {
				$record['countries'][] = array(trim(explode(">", $value)[1]), $value);
			}
		}

		//Add SDG
		if(!empty($record['tags']['sdg'])){
			foreach ($record['tags']['sdg'] as $key => $value) {
				$array_data = explode(":", $value);
				$record['sdg_icon'][] = array(strtolower(preg_replace('/\s+/', '', $array_data[0])), $value);
			}
		}

		if(!empty($post_meta[0]['DOI'])){
			$record['icon_domain_source'] = addhttpsDOI($post_meta[0]['DOI']);
		}elseif(!empty($post_meta[0]['url'])){
			$record['icon_domain_source'] = $post_meta[0]['url'];
		}else{
			$record['icon_domain_source'] = "empty";
		}

		return $record;
	}

	/** Post */
	if($post->post_type == 'post'){
		
		$post_meta 		= get_post_meta($post->ID, 'zotero-data');
		$post_thumb_id	= get_post_thumbnail_id($post->ID);
		$post_thumb_url	= $post_thumb_id > 0 ? wp_get_attachment_image_src( $post_thumb_id, 'medium' )[0] : '';
		
		if(!empty($post_meta)){
			$record= [
				'item_type' => ucfirst(preg_replace( '/([a-z0-9])([A-Z])/', "$1 $2", $post_meta[0]['itemType'])),
			];
		}
		
		$record = [
			'objectID' => implode('#', [ $post->post_type, $post->ID ]),
			'post_type' => $post->post_type,
			'post_title' => $post->post_title,
			'post_date' => $post->post_date,
			'post_date_gmt' => $post->post_date_gmt,
			'post_content' => strip_tags( $post->post_content ),
			'excerpt' => $post->post_excerpt,
			'url' => get_post_permalink( $post->ID ),
			'publication_title' => get_bloginfo('name'),
			'website_title' => get_bloginfo('name'),
			'authors' => get_post_author( $post, $post_meta ),
			'tags' => get_post_tags( $post->ID ),
			'volume' => "",
			'pages' => "",
			'language' => "English",
			'ISSN' => "",
			'short_title' => "",
			'url' => get_permalink($post->ID),
			'library_catalog' => get_bloginfo('name'),
			'post_thumb_url' => $post_thumb_url,
			'year' => get_the_date( 'Y', $post->ID ),
			'icon_domain_source' => get_site_url()
		];

		//Add countries
		if(!empty($record['tags']['region']['lvl1'])){
			foreach ($record['tags']['region']['lvl1'] as $key => $value) {
				$record['countries'][] = array(trim(explode(">", $value)[1]), $value);
			}
		}

		//Add SDG
		if(!empty($record['tags']['sdg'])){
			foreach ($record['tags']['sdg'] as $key => $value) {
				$array_data = explode(":", $value);
				$record['sdg_icon'][] = array(strtolower(preg_replace('/\s+/', '', $array_data[0])), $value);
			}
		}

		return $record;
	}
}

add_filter('post_to_record', 'algolia_post_to_record');
add_filter('publication_to_record', 'algolia_post_to_record');


/**
 *  Fires once a post has been saved and update Algolia items
 * @param int $id
 * @param WP_Post $post
 * @param bool $update
 * @return array
 */
function algolia_update_post($id, WP_Post $post, $update) {
	
	$array_post_type = array("post", "publication");
	
    if (wp_is_post_revision($id) || wp_is_post_autosave($id) || !in_array($post->post_type, $array_post_type)) {
        return $post;
    }

    global $algolia;

    $record = (array) apply_filters($post->post_type.'_to_record', $post);

    if (!isset($record['objectID'])) {
      $record['objectID'] = implode('#', [$post->post_type, $post->ID]);
    }

    $index = $algolia->initIndex(ALGOLIA_INDEX);

    if ('trash' == $post->post_status) {
        $index->deleteObject($record['objectID']);
    } else {
		if ('publish' == $post->post_status) {
			$index->saveObject($record);
		}
    }

    return $post;
}

add_action('save_post', 'algolia_update_post', 10, 3);


/**
 * Send email for notificacion on pending status (post)
 */
function pending_update_post($post_id, $post){

	$transient_data = get_transient($post->post_title);

	if ( !$transient_data ) {
		$headers[]    = 'Content-Type: text/html; charset=UTF-8';
		$subject_user = "[".$post->post_status."] ".$post->post_title;
		$body 		  = 'Hello Foresight, You have new content to approve. <a href="'.admin_url( 'post.php?post='.$post->ID.'&action=edit', 'https' ).'">Click here to enter</a>';
		$email		  = EMAIL_NOTIFICATION;
		
		if ( !empty($email) ){
			$response_mail_user = wp_mail( $email, $subject_user, $body, $headers );
			
			if($response_mail_user){
				set_transient($post->post_title, true, 8 * HOUR_IN_SECONDS);
			}
		}
		
	}
}

add_action('pending_post', 'pending_update_post', 10, 2);

/**
 * Delete transient on change status: pending to publish
 */
function pending_to_publish_update_post( $post ){
	delete_transient($post->post_name);
}

add_action('pending_to_publish', 'pending_to_publish_update_post', 10, 1);

/**
 * Get author post
 * @param WP_Post $post
 * @param array $post_meta
 * @return array
 */
function get_post_author( $post, $post_meta ){

	if($post->post_type == 'post'){
		$author[]= array( "creatorType" => "author", "firstName" => get_the_author_meta('first_name', $post->post_author), "lastName" => get_the_author_meta('last_name', $post->post_author));
	}else{
		$author = $post_meta[0]['creators'];
	}
	return $author;
}

/**
 * Get Tags
 * @param WP_Post $post
 * @param array $post_meta
 * @return array
 */
function get_post_tags( $post_id ){

	$array_taxonomy 			= array('post_tag', 'publish-year', 'agrifood-system', 'approach', 'sdg', 'impact-area');
	$array_taxonomy_hierarchy 	= array('region', 'product-type' );
	$tags = array();
	
	foreach ($array_taxonomy as $key => $taxonomy) {
		$tags[$taxonomy] = array_map(function (WP_Term $term) {
			return $term->name;
		}, wp_get_post_terms($post_id, $taxonomy));
	}

	$lvl0 = array();
	$lvl1 = array();
	$lvl2 = array();
	$lvl3 = array();
	
	foreach ($array_taxonomy_hierarchy as $key => $taxonomy) {
		
		//Get all terms in Post
		$terms =  wp_get_post_terms($post_id, $taxonomy);
		$separator = " > ";
		
		foreach ($terms as $k => $term) {
			$levels = explode( $separator, rtrim( get_term_parents_list( $term->term_id, $taxonomy, array('separator' => $separator,'link' => false) ), $separator ) );
		
			foreach ($levels as $i => $v) {
				
				if($i == 0){
					$str_value = $v;
				}

				if($i == 1){
					$str_value = $levels[$i - 1] . $separator . $v;
				}

				if($i == 2){
					$str_value = $levels[$i - 2] . $separator . $levels[$i - 1] . $separator . $v;
				}

				if($i == 3){
					$str_value = $levels[$i - 3] .$separator . $levels[$i - 2] . $separator . $levels[$i - 1] . $separator . $v;
				}

				if($i == 4){
					$str_value = $levels[$i - 4]. $separator .  $levels[$i - 3] . $separator . $levels[$i - 2] . $separator . $levels[$i - 1] . $separator . $v;
				}

				if (empty($tags[$taxonomy]['lvl' . $i])) {
					$tags[$taxonomy]['lvl' . $i][] = $str_value;
				}
			}
		}
	}
	return $tags;
}

/**
 * Enqueue scripts and styles.
 */
function algolia_foresight_plugin_scripts() {
	global $template;
	$template_name = basename( $template, ".php" );

	if($template_name == 'page-search'){
		// Algolia SDK
		wp_enqueue_style('instantsearch-reset', 'https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css', array(), _S_VERSION);
		wp_enqueue_style('algolia-theme', get_template_directory_uri().'/static/algolia/theme.css', array(), _S_VERSION);
		wp_enqueue_style('algolia-app-desktop', get_template_directory_uri().'/static/algolia/app.desktop.css', array('algolia-theme'), _S_VERSION);
		wp_enqueue_style('algolia-app-mobile', get_template_directory_uri().'/static/algolia/app.mobile.css', array('algolia-theme'), _S_VERSION);
		wp_enqueue_style('algolia-year-slider', get_template_directory_uri().'/static/algolia/year-slider.css', array('algolia-theme'), _S_VERSION);
		wp_enqueue_script( 'algolia-app', get_template_directory_uri().'/static/algolia/app.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'polyfill', 'https://polyfill.io/v3/polyfill.js?features=default%2CArray.prototype.find%2CArray.prototype.includes%2CPromise%2CObject.assign%2CObject.entries', array(), _S_VERSION, false );
	}
}

add_action( 'wp_enqueue_scripts', 'algolia_foresight_plugin_scripts' );


/**
 * Filter script_loader_tag type module
 */
function add_type_module($tag, $handle, $src) {

	if (strpos($handle, 'module-') !== false) {
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		return $tag;
	}
    return $tag;
}

add_filter('script_loader_tag', 'add_type_module' , 10, 3);


/**
 * Add url scheme
 */
function addhttpsDOI($url) {
	if(!empty($url)){
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "https://doi.org/" . $url;
		}
		return $url;
	}
	return $url;
}