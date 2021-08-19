<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_settings_page_import_list() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		set_transient( 'clarisa_regions', '[{"id":1,"name": "Region 1"},{"id":2,"name": "Region 2"}]' );
		set_transient( 'clarisa_sdgs', '[{"id":1,"name": "GOAL 1"},{"id":2,"name": "GOAL 2"}]' );
		set_transient( 'clarisa_impact_areas', '[{"id":1,"name": "Area 1"},{"id":2,"name": "Area 2"}]' );

		acf_add_local_field_group(
			[
				'key' => 'group_foresight_settings_import_list',
				'title' => 'IMPORT DATA',
				'fields' => [
					[
						'key' => 'field_import_list',
						'label' => '',
						'name' => 'button_import',
						'type' => 'button',
						'value' => 'Import All Control List',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '100',
							'class' => '',
							'id' => '',
						],
					],
				],
				'location' => [
					[
						[
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'theme-general-settings',
						],
					],
				],
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			]
		);
	}
}

add_action( 'init', 'register_custom_acf_fields_settings_page_import_list' );



function acf_enqueue_admin_script_foresight( $hook ) {

    if ( 'toplevel_page_theme-general-settings' != $hook ) {
        return;
    }
	
    wp_enqueue_script( 'acf-settings-page', get_template_directory_uri() . '/static/js-admin/acf-settings-page.js', array('jquery'), _S_VERSION, true );
	wp_localize_script( 'acf-settings-page', 'ajax_var', array(
        'url'    => admin_url( 'admin-ajax.php' ),
        'nonce'  => wp_create_nonce( 'foresight-ajax-nonce' ),
        'action' => 'import-clarisa'
    ));
}

add_action( 'admin_enqueue_scripts', 'acf_enqueue_admin_script_foresight' );


function foresight_import_clarisa_cb() {
    // Check for nonce security
    $nonce = sanitize_text_field( $_POST['nonce'] );

    if ( ! wp_verify_nonce( $nonce, 'foresight-ajax-nonce' ) ) {
        die ( 'Unauthorized');
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
	$log['sdg_response'] = $response['response'];
	$response['body'] = json_decode($response['body']);
	
	foreach ($response['body'] as $key => $term) {
		$args = array( 'description' => $term->fullName, 'slug' => 'goal-'.$term->smoCode );
		$term_id = wp_insert_term( $term->shortName, 'sdg', $args );
		if(!is_wp_error($term_id)){
			$log['sdg_count']++;
			$log['sdg_insert_term'][$key] = $term_id;
			add_term_meta($term_id['term_id'], 'clarisa_id', $term->smoCode);
		}else{
			$log['sdg_insert_term'][$key] = $term_id->errors;
		}
		$term_id = null;
	}
	// end import SDGs

	// begin import impact areas
	$endpoint = $options_page['clarisa_url_impact_areas'];
	$response = wp_remote_get( $endpoint, $options );
	$log['impact_areas_response'] = $response['response'];
	$response['body'] = json_decode($response['body']);
	
	foreach ($response['body'] as $key => $term) {
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
	}
	// end import impact areas

	// begin import regions
	$endpoint = $options_page['clarisa_url_regions'];
	$response = wp_remote_get( $endpoint, $options );
	$log['regions_response'] = $response['response'];
	$response['body'] = json_decode($response['body']);
	
	foreach ($response['body'] as $key => $term) {
		
		$term_id = wp_insert_term( $term->name, 'region' );
		
		if(!is_wp_error($term_id)){
			$log['regions_count']++;
			$log['regions_insert_term'][$key] = $term_id;
			$parent_id = $term_id['term_id'];
			add_term_meta($term_id['term_id'], 'clarisa_id', $term->id);
		}else{
			$parent_id = term_exists( $term->name, 'region' )['term_id'];
			$log['regions_insert_term'][$key] = $term_id->errors;
		}

		foreach ($term->countries as $k => $country) {

			$args = array( 'parent' => $parent_id, 'slug' => $country->isoAlpha2 );
			$term_id = wp_insert_term( $country->name, 'region', $args );
			
			if(!is_wp_error($term_id)){
				$log['regions_count']++;
				add_term_meta($term_id['term_id'], 'clarisa_id', $country->isoAlpha2);
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
	//Register log impact areas
	$array_log['impact_areas_response'] = $log['impact_areas_response'];
	$array_log['impact_areas_insert_term'] = $log['impact_areas_insert_term'];
	$array_log['impact_areas_count'] = $log['impact_areas_count'] | 0;
	//Register log regions
	$array_log['regions_response'] = $log['regions_response'];
	$array_log['regions_insert_term'] = $log['regions_insert_term'];
	$array_log['regions_count'] = $log['regions_count'] | 0;

	set_transient( 'log_clarisa', $array_log );	
	wp_send_json( $array_log, 200 );

}

add_action( 'wp_ajax_import-clarisa', 'foresight_import_clarisa_cb' );