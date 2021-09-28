<?php
/**
 * This function records fields for the acf.
 */

function acf_enqueue_admin_script_foresight( $hook ) {

    if ( 'toplevel_page_theme-general-settings' != $hook ) {
        return;
    }
	
	wp_enqueue_style( 'jquery-modal', get_template_directory_uri() . '/static/assets-admin/jquery.modal.min.css' );
	wp_enqueue_script ( 'jquery-modal', get_template_directory_uri() . '/static/assets-admin/jquery.modal.min.js', array('jquery') );
    wp_enqueue_script( 'acf-settings-page', get_template_directory_uri() . '/static/assets-admin/acf-settings-page.js', array('jquery-modal'), _S_VERSION, true );
	wp_localize_script( 'acf-settings-page', 'ajax_var', array(
        'url'    => admin_url( 'admin-ajax.php' ),
        'nonce'  => wp_create_nonce( 'foresight-ajax-nonce' ),
        'action_import_clarisa' => 'import-clarisa',
		'action_import_zotero' => 'import-zotero',
		'action_show_tags' => 'show-tags'
    ));
}

add_action( 'admin_enqueue_scripts', 'acf_enqueue_admin_script_foresight' );


function foresight_import_clarisa_cb() {
    // Check for nonce security
    $nonce = sanitize_text_field( $_POST['nonce'] );
	$objError = new WP_Error();

    if ( ! wp_verify_nonce( $nonce, 'foresight-ajax-nonce' ) ) {
		$objError->add('invalid-nonce', 'Unauthorized');
        wp_send_json_error( $objError, 500 );
    }

	//Authorization CLARISA
	$options_page  = get_fields( 'theme-general-settings' );
	$username = $options_page['clarisa_username'];
	$password = $options_page['clarisa_password'];
	$options = [
		'headers'     => [
			'Authorization' => 'Basic ' . base64_encode( $username . ':' . $password ),
		],
		'timeout'     => 60,
	];

	// begin import SDGs
	$endpoint = $options_page['clarisa_url_sdgs'];
	$response = wp_remote_get( $endpoint, $options );

	if(is_array($response->errors)){

		foreach ($response->errors as $code => $message) {
			$objError->add($code, implode(' ', $message));
		}
		wp_send_json_error( $objError, 500 );
	}
	
	$log['sdg_response'] = $response['response'];
	$response['body'] = json_decode($response['body']);
	
	foreach ($response['body'] as $key => $term) {

		$exist_term = search_terms_by_clarisa_id( 'sdg', 'clarisa_id', $term->usndCode );
		if(count($exist_term) == 0){

			$args = array( 'description' => $term->fullName, 'slug' => 'goal-'.$term->usndCode );
			$term_id = wp_insert_term( $term->shortName, 'sdg', $args );
			if(!is_wp_error($term_id)){
				$log['sdg_count']++;
				$log['sdg_insert_term'][$key] = $term_id;
				add_term_meta($term_id['term_id'], 'clarisa_id', $term->usndCode);
			}else{
				$log['sdg_insert_term'][$key] = $term_id->errors;
			}
			$term_id = null;

		}else{
			wp_update_term($exist_term[0]->term_id, 'sdg', array('name' => $term->shortName, 'description' => $term->fullName));
			$log['sdg_count_updated']++;
		}
	}
	// end import SDGs

	// begin import impact areas
	$endpoint = $options_page['clarisa_url_impact_areas'];
	$response = wp_remote_get( $endpoint, $options );
	$log['impact_areas_response'] = $response['response'];
	$response['body'] = json_decode($response['body']);
	
	foreach ($response['body'] as $key => $term) {

		$exist_term = search_terms_by_clarisa_id( 'impact-area', 'clarisa_id', $term->id );

		if(count($exist_term) == 0){
			
			$args = array( 'description' => $term->description, 'slug' => '' );
			$term_id = wp_insert_term( $term->name, 'impact-area', $args );
			if(!is_wp_error($term_id)){
				$log['impact_areas_count']++;
				$log['impact_areas_insert_term'][$key] = $term_id;
				add_term_meta($term_id['term_id'], 'clarisa_id', $term->id);
			}else{
				$log['impact_areas_insert_term'][$key] = $term_id->errors;
			}
			$term_id = null;

		}else{
			wp_update_term($exist_term[0]->term_id, 'impact-area', array('name' => $term->name, 'description' => $term->description));
			$log['impact_areas_count_updated']++;
		}
	}
	// end import impact areas

	// begin import regions
	$endpoint = $options_page['clarisa_url_regions'];
	$response = wp_remote_get( $endpoint, $options );
	$log['regions_response'] = $response['response'];
	$response['body'] = json_decode($response['body']);
	
	foreach ($response['body'] as $key => $term) {

		$exist_term = search_terms_by_clarisa_id( 'region', 'clarisa_id', $term->id );

		if(count($exist_term) == 0){
			
			$term_id = wp_insert_term( $term->name, 'region' );
		
			if(!is_wp_error($term_id)){
				$log['regions_count']++;
				$log['regions_insert_term'][$key] = $term_id;
				$parent_id = $term_id['term_id'];
				add_term_meta($term_id['term_id'], 'clarisa_id', $term->acronym);
			}else{
				$parent_id = term_exists( $term->name, 'region' )['term_id'];
				$log['regions_insert_term'][$key] = $term_id->errors;
			}

		}else{
			wp_update_term($exist_term[0]->term_id, 'region', array( 'name' => $term->name ));
			$parent_id = $exist_term[0]->term_id;
			$log['regions_count_updated']++;
		}
		

		foreach ($term->countries as $k => $country) {

			$exist_term = search_terms_by_clarisa_id( 'region', 'clarisa_id', $country->isoAlpha2 );

			if(count($exist_term) == 0){
				$args = array( 'parent' => $parent_id, 'slug' => $country->isoAlpha2 );
				$term_id = wp_insert_term( $country->name, 'region', $args );
				
				if(!is_wp_error($term_id)){
					$log['regions_count']++;
					add_term_meta($term_id['term_id'], 'clarisa_id', $country->isoAlpha2);
				}	
			}else{
				wp_update_term($exist_term[0]->term_id, 'region', array( 'name' => $country->name ));
				$log['regions_count_updated']++;
			}	
		}

		$term_id = null;
	}
	//end import regions

	//Register log SDGs
	$array_log['date'] = date("Y-m-d H:i:s");
	$array_log['sdg_response'] = $log['sdg_response'];
	$array_log['sdg_insert_term'] = $log['sdg_insert_term'];
	$array_log['sdg_count'] = $log['sdg_count'] | 0;
	$array_log['sdg_count_updated'] = $log['sdg_count_updated'] | 0;
	//Register log impact areas
	$array_log['impact_areas_response'] = $log['impact_areas_response'];
	$array_log['impact_areas_insert_term'] = $log['impact_areas_insert_term'];
	$array_log['impact_areas_count'] = $log['impact_areas_count'] | 0;
	$array_log['impact_areas_count_updated'] = $log['impact_areas_count_updated'] | 0;
	//Register log regions
	$array_log['regions_response'] = $log['regions_response'];
	$array_log['regions_insert_term'] = $log['regions_insert_term'];
	$array_log['regions_count'] = $log['regions_count'] | 0;
	$array_log['regions_count_updated'] = $log['regions_count_updated'] | 0;

	set_transient( 'log_clarisa', $array_log );	
	wp_send_json( $array_log, 200 );

}

add_action( 'wp_ajax_import-clarisa', 'foresight_import_clarisa_cb' );

/**
 * Search terms by clarisa_id
 * @param string $taxonomy
 * @param string $key (metadata)
 * @param string $value (metadata)
 * @return array Terms
 */
function search_terms_by_clarisa_id( $taxonomy, $key, $value ){

	$args = array(
		'hide_empty' => false,
		'meta_query' => array(
			array(
			   'key'       => $key,
			   'value'     => $value,
			   'compare'   => '='
			)
		),
		'taxonomy'  => $taxonomy,
		);
		$terms = get_terms( $args );
		return $terms;
}


/**
 * Show tag that did not pass the taxonomy filter
 */
function foresight_show_tags_cb(){

	// Check for nonce security
    $nonce = sanitize_text_field( $_POST['nonce'] );
	$objError = new WP_Error();

    if ( ! wp_verify_nonce( $nonce, 'foresight-ajax-nonce' ) ) {
		$objError->add('invalid-nonce', 'Unauthorized');
        wp_send_json_error( $objError, 500 );
    }

	$postID = sanitize_text_field( $_POST['postID'] );
	$tags = get_post_meta($postID, 'zotero-data', true);
	
	$html = '<div class="modal"><div style="height:400px;overflow: -moz-scrollbars-vertical;overflow-y:scroll">';
	$html .= '<p><h1>Associated terms:</h1>';
	foreach ($tags['tags'] as $key => $terms) {
		
		$html .= '<p><h3>Taxonomy: ['.$key.']</h3>';

		foreach ($terms as $k => $v) {
			if( $key == 'tags' ){
				$html .= '<li>'.$v.'</li>';
			}else{
				$t = get_term( $v, $key );
				$html .= '<li>'.$t->name.'</li>';
			}
		}
		
		$html .= '</ul></p>';
	}

	if(empty($tags['tags'])){
		$html .= '<p><h2>No registered tags.</h2></p>';
	}

	$html .= '</div></div>';
	wp_send_json($html, 200);
}

add_action( 'wp_ajax_show-tags', 'foresight_show_tags_cb' );


/**
 * Import content from Zotero to Wordpress
 */
function foresight_import_zotero_cb() {
    // Check for nonce security
    $nonce = sanitize_text_field( $_POST['nonce'] );
	$objError = new WP_Error();

    if ( ! wp_verify_nonce( $nonce, 'foresight-ajax-nonce' ) ) {
		$objError->add('invalid-nonce', 'Unauthorized');
        wp_send_json_error( $objError, 500 );
    }

	//Authorization Zotero
	$options_page  			= get_fields( 'theme-general-settings' );
	$zotero_apikey 			= $options_page['zotero_apikey'];
	$zotero_api_version 	= $options_page['zotero_api_version'];
	$zotero_api_group_id 	= $options_page['zotero_api_group_id'];
	$zotero_api_url 		= $options_page['zotero_api_url'];
	$zotero_wp_author_id	= $options_page['zotero_wp_author_id'];
	$zotero_wp_category_id	= $options_page['zotero_wp_category_id'];
	$zotero_api_collections = explode( ',', $options_page['zotero_api_collections'] );
	$options = [
		'headers'     => [
			'Zotero-API-Key' => $zotero_apikey,
			'Zotero-API-Version' => $zotero_api_version
		],
		'timeout'     => 60,
	];

	// Begin import Zotero
	foreach ( $zotero_api_collections as $collection_id ) {
		$limit = 100;
		$start = $limit;
		$last_version[$collection_id] = get_transient( 'zotero_version_'.$collection_id ) | '0';
		/** exlude attachment and notes */
		$endpoint = $zotero_api_url . "/groups/" . $zotero_api_group_id.'/collections/'.$collection_id.'/items?itemType=-attachment%20%7C%7C%20note&limit='.$limit.'&format=json&since='.$last_version[$collection_id];
		
		$response = wp_remote_get( $endpoint, $options );
		
		// handle connection error
		if ( is_wp_error( $response ) ){
			foreach ($response->errors as $code => $message) {
				$objError->add($code, implode(' ', $message));
			}
			wp_send_json_error( $objError, 500 );
		}

		// handle data error
		if($response['response']['code'] != '200'){
			$objError->add($response['response']['code'], $response['body']);
			wp_send_json_error( $objError, 500 );
		}

		$items[$collection_id] = json_decode($response['body'], true);

		$headerResult 	= wp_remote_retrieve_headers($response);
		$total_results 	= $headerResult['total-results'];
		
		/** begin pagination 
		 * Zotero uses pagination for results with more than 100 records
		*/
		if($total_results > $limit){
			$total_pages 	= ceil($total_results / $limit);
			for ($i=1; $i < $total_pages; $i++) {
				$endpoint = $zotero_api_url . "/groups/" . $zotero_api_group_id.'/collections/'.$collection_id.'/items?itemType=-attachment%20%7C%7C%20note&limit='.$limit.'&format=json&start='.($start * $i).'&since='.$last_version[$collection_id];
				$response = wp_remote_get( $endpoint, $options );

				// handle connection error
				if ( is_wp_error( $response ) ){
					foreach ($response->errors as $code => $message) {
						$objError->add($code, implode(' ', $message));
					}
					wp_send_json_error( $objError, 500 );
				}

				// handle data error
				if($response['response']['code'] != '200'){
					$objError->add($response['response']['code'], $response['body']);
					wp_send_json_error( $objError, 500 );
				}

				$items_page = json_decode($response['body'], true);
				$items[$collection_id] = array_merge($items[$collection_id], $items_page);
			}
		}
		/** end pagination */

		$version = get_last_version_collection($items[$collection_id], $last_version[$collection_id]);
		$array_log['zotero_count'] .= '<p><b>Collection: </b>'.$collection_id.'<br><b>Version: </b>'.$version.'<br><b>Items updated: </b> '.count($items[$collection_id]).'</p>';
		
		//Create custom post
		$child_nodes = array();
		
		foreach ($items[$collection_id] as $key => $item) {
			if( !empty($item['data']['parentItem']) ){
				$child_nodes[] = $item; //child nodes
			}else{
				
				$post_id = get_publication_by_key( $item['data']['key'] ); // validate if publication exist (zotero key)
				$item['data']['year'] = ( !empty($item['meta']['parsedDate']) ) ? (explode('-', $item['meta']['parsedDate'])[0]) : "";
				$item['data']['zoteroUrl'] = $item['links']['alternate']['href'];

				switch ($item['data']['itemType']) {
					case 'case':
						$item['data']['title'] = $item['data']['caseName'];
						break;
					case 'email':
						$item['data']['title'] = $item['data']['subject'];
						break;
					case 'statute':
						$item['data']['title'] = $item['data']['nameOfAct'];
						break;
				}
				
				$array_terms = array();
				
				foreach ($item['data']['tags'] as $i => $tag) {
					
					//validate if tag exists and add to whitelist
					
					$tag_exist	= false;
					$tag_id 	= term_exists( $tag['tag'], 'product-type' );
					if(!empty($tag_id)){
						$array_terms['product-type'][] = $tag_id['term_id'];
						$tag_exist = true;
					}
					
					$tag_id = term_exists( $tag['tag'], 'agrifood-system' );
					if(!empty($tag_id)){
						$array_terms['agrifood-system'][] = $tag_id['term_id'];
						$tag_exist = true;
					}

					$tag_id = term_exists( $tag['tag'], 'approach' );
					if(!empty($tag_id)){
						$array_terms['approach'][] = $tag_id['term_id'];
						$tag_exist = true;
					}

					$tag_id = term_exists( $tag['tag'], 'region' );
					if(!empty($tag_id)){
						$array_terms['region'][] = $tag_id['term_id'];
						$tag_exist = true;
					}

					$tag_id = term_exists( $tag['tag'], 'sdg' );
					if(!empty($tag_id)){
						$array_terms['sdg'][] = $tag_id['term_id'];
						$tag_exist = true;
					}

					$tag_id = term_exists( $tag['tag'], 'impact-area' );
					if(!empty($tag_id)){
						$array_terms['impact-area'][] = $tag_id['term_id'];
						$tag_exist = true;
					}

					if( !$tag_exist ){
						$array_terms['tags'][] = $tag['tag'];
					}
				}

				$item['data']['tags'] = $array_terms; //overwrite tags
				
				if( !$post_id ){ // NEW PUBLICATION
					
					$post_id = foresight_create_publication( $zotero_wp_author_id, $zotero_wp_category_id, $item['data'] );

					if($post_id == -1){
						$array_log['zotero_wp_conflicts'] .= '<li><b style="color:red">slug already exists: </b>'.sanitize_title( $item['data']['title'] ).'</li>';
					}else{
						$array_log['zotero_wp_conflicts'] .= '<li><b style="color:green">Successful: </b>'.sanitize_title( $item['data']['title'] ).' <a href="#" data-post-id="'.$post_id.'" class="modal-show-tag" id="foresight-modal-tag">Show summary</a></li>';
					}
					
				}else{ // UPDATE PUBLICATION
					
					$post_id = foresight_update_publication( $post_id, $item['data'] );
					
					if($post_id > 0){
						$array_log['zotero_wp_conflicts'] .= '<li><b style="color:green">Successful: </b>'.sanitize_title( $item['data']['title'] ).' <a href="#" data-post-id="'.$post_id.'" class="modal-show-tag" id="foresight-modal-tag">Show summary</a></li>';
					}
				}
			}
		}
		
		//save collection last version
		set_transient('zotero_version_'.$collection_id, $version);
	}
	// End import Zotero

	$array_log['date'] = date("Y-m-d H:i:s");
	$array_log['zotero_response'] = $response['response'];
	set_transient( 'log_zotero', $array_log );
	wp_send_json( $items, 200 );
}

add_action( 'wp_ajax_import-zotero', 'foresight_import_zotero_cb' );


/**
 * Get publication by Key (Zotero)
 * @param string $key from Zotero
 * @return array Post
 */
 function get_publication_by_key( $key ){
	$args = array(
		'post_type'  => 'publication',
		'meta_query' => array(
			array(
				'key'     => 'zotero-key',
				'value'   => $key,
				'compare' => '=',
			),
		),
	);
	$query = new WP_Query( $args );
	$post_id = ( !empty($query->posts) ) ? $query->posts[0]->ID : 0;
	return $post_id;
 }



/**
 * Get last version for Zotero collection 
 * @param array $items from Zotero.
 * @return number last version
 */
function get_last_version_collection( $items, $current_version ){
	$version = $current_version;
	foreach ($items as $key => $item) {
		$version = ($item['version'] > $version) ? $item['version'] : $version;
	}
	return $version;
}

/**
 * Create new publication in Wordpress
 * @param array $post
 * @return number ID
 */
function foresight_create_publication( $autor_id, $category_id, $args ){
	$post_args = array(
		'post_author'  => $autor_id,
		'post_category'=> array($category_id),
		'tags_input'   => $args['tags']['tags'],
		'post_title'   => $args['title'],
		'post_name'	   => sanitize_title( $args['title'] ),
		'post_content' => $args['abstractNote'],
		'post_status'  => 'publish',
		'post_type'	   => 'publication',
		'meta_input'   => array(
			'zotero-key' => $args['key'],
			'zotero-data' => $args,
		),
		'tax_input'    => array(
			'publish-year' => $args['year'],
			'product-type' => $args['tags']['product-type'],
			'agrifood-system' => $args['tags']['agrifood-system'],
			'approach' => $args['tags']['approach'],
			'region' => $args['tags']['region'],
			'sdg' => $args['tags']['sdg'],
			'impact-area' => $args['tags']['impact-area']
		),
	);
	if( !post_exists( $post_args['post_title'], '', '', 'publication' ) ) {
		return wp_insert_post( $post_args, true );
	}else{
		// when the slug of a post already exists it is marked as a conflict
		return -1;
	}
}

/**
 * Update publication in Wordpress
 * @param array $post
 * @return bool
 */
function foresight_update_publication( $post_id, $args ){
	$post_args = array(
		'ID'           => $post_id,
		'post_title'   => $args['title'],
		'post_name'	   => sanitize_title( $args['title'] ),
		'post_content' => $args['abstractNote'],
		'tags_input'   => $args['tags']['tags'],
		'meta_input'   => array(
			'zotero-data' => $args,
		),
		'tax_input'    => array(
			"publish-year" => $args['year'],
			'product-type' => $args['tags']['product-type'],
			'agrifood-system' => $args['tags']['agrifood-system'],
			'approach' => $args['tags']['approach'],
			'region' => $args['tags']['region'],
			'sdg' => $args['tags']['sdg'],
			'impact-area' => $args['tags']['impact-area']
		),
	);
	return wp_update_post( $post_args );
}