<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_settings_page() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		$log_clarisa = get_transient( 'log_clarisa' );
		$log_zotero = get_transient( 'log_zotero' );
		
		$log_clarisa = 	"<b>Last update: </b>".$log_clarisa['date']."<br>".
						"<h3>SDGs</h3>".
						"<b>Total Imported Items: </b>".$log_clarisa['sdg_count']."<br>".
						"<b>Total Updated Items: </b>".$log_clarisa['sdg_count_updated']."<br>".
						"<b>Clarisa Response: </b>".json_encode($log_clarisa['sdg_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_clarisa['sdg_insert_term']).'<br>'.
						"<h3>Impact Areas</h3>".
						"<b>Total Imported Items: </b>".$log_clarisa['impact_areas_count']."<br>".
						"<b>Total Updated Items: </b>".$log_clarisa['impact_areas_count_updated']."<br>".
						"<b>Clarisa Response: </b>".json_encode($log_clarisa['impact_areas_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_clarisa['impact_areas_insert_term']).'<br>'.
						"<h3>Regions</h3>".
						"<b>Total Imported Items: </b>".$log_clarisa['regions_count']."<br>".
						"<b>Total Updated Items: </b>".$log_clarisa['regions_count_updated']."<br>".
						"<b>Clarisa Response: </b>".json_encode($log_clarisa['regions_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_clarisa['regions_insert_term']).'<br>';
		
		$log_zotero = 	"<b>Last update: </b>".$log_zotero['date']."<br>".
						"<b>Version: </b>".$log_zotero['version']."<br>".
						"<h3>ZOTERO ITEMS</h3>".
						"<b>Total Imported Items: </b>".$log_zotero['zotero_count']."<br>".
						"<b>Total Updated Items: </b>".$log_zotero['zotero_count_updated']."<br>".
						"<b>Zotero Response: </b>".json_encode($log_zotero['zotero_response']).'<br>'.
						"<b>Wordpress Response: </b>".json_encode($log_zotero['zotero_insert_term']);


		acf_add_local_field_group(
			[
				'key'                   => 'group_foresight_settings',
				'title'                 => 'Foresight',
				'fields'                => [
					[
						'key'               => 'field_settings_tab_1',
						'label'             => 'Contact',
						'name'              => '',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 1,
					],
					[
						'key'               => 'field_settings_contact_us_address',
						'name'              => 'contact_us_address',
						'label'             => 'Address',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '33',
						],
					],
					[
						'key'               => 'field_settings_contact_us_phone',
						'name'              => 'contact_us_phone',
						'label'             => 'Phone',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '33',
						],
					],
					[
						'key'               => 'field_settings_contact_us_email',
						'name'              => 'contact_us_email',
						'label'             => 'Email',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '33',
						],
					],
					[
						'key'          => 'field_recaptcha_section',
						'label'        => 'Recaptcha',
						'name'         => 'recaptcha_section',
						'type'         => 'tab',
						'instructions' => 'Information required for the Recaptcha',
						'required'     => 1,
						'placement'    => 'top',
						'endpoint'     => 0,
					],
					[
						'key'      => 'field_recaptcha_secret_key',
						'label'    => 'Secret Key',
						'name'     => 'recaptcha_secret_key',
						'type'     => 'text',
						'required' => 1,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_recaptcha_site_key',
						'label'    => 'Site Key',
						'name'     => 'recaptcha_site_key',
						'type'     => 'text',
						'required' => 1,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_recaptcha_score',
						'label'    => 'Score',
						'name'     => 'recaptcha_score',
						'type'     => 'text',
						'required' => 1,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'               => 'field_settings_tab_zotero',
						'label'             => 'Zotero API',
						'name'              => '',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'      => 'field_zotero_apikey',
						'label'    => 'API Key',
						'name'     => 'zotero_apikey',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_zotero_api_version',
						'label'    => 'API Version',
						'name'     => 'zotero_api_version',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_zotero_api_user_id',
						'label'    => 'UserID',
						'name'     => 'zotero_api_user_id',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_zotero_api_url',
						'label'    => 'Base URL',
						'name'     => 'zotero_api_url',
						'type'     => 'text',
						'required' => 0,
						'instructions'      => 'Base connection URL',
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_zotero_api_collections',
						'label'    => 'Collections',
						'name'     => 'zotero_api_collections',
						'type'     => 'text',
						'required' => 0,
						'instructions'      => 'Add multiple collection IDs separated by commas',
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key' => 'field_import_zotero',
						'label' => '',
						'name' => 'button_import_zotero',
						'type' => 'button',
						'value' => 'Import Zotero Items',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '100',
							'class' => '',
							'id' => '',
						],
					],
					[
						'key' => 'field_zotero_log',
						'name' => '',
						'type' => 'message',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'message' => $log_zotero,
						'esc_html' => 0,
						'wrapper' => [
							'width' => '100',
							'class' => '',
							'id' => '',
						],
					],


					[
						'key'               => 'field_settings_tab_clarisa',
						'label'             => 'Clarisa API',
						'name'              => '',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'      => 'field_clarisa_username',
						'label'    => 'Username',
						'name'     => 'clarisa_username',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '50',
						],
					],
					[
						'key'      => 'field_clarisa_password',
						'label'    => 'Password',
						'name'     => 'clarisa_password',
						'type'     => 'password',
						'required' => 0,
						'wrapper'  => [
							'width' => '50',
						],
					],

					[
						'key'      => 'field_clarisa_url_regions',
						'label'    => 'Url Regions',
						'name'     => 'clarisa_url_regions',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_clarisa_url_impact_areas',
						'label'    => 'Url Impact Areas',
						'name'     => 'clarisa_url_impact_areas',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'      => 'field_clarisa_url_sdgs',
						'label'    => 'Url SDGs',
						'name'     => 'clarisa_url_sdgs',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
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
					[
						'key' => 'field_list_control',
						'name' => '',
						'type' => 'message',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'message' => $log_clarisa,
						'esc_html' => 0,
						'wrapper' => [
							'width' => '100',
							'class' => '',
							'id' => '',
						],
					],
				],
				'location'              => [
					[
						[
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'theme-general-settings',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
			]
		);
	}
}

add_action( 'init', 'register_custom_acf_fields_settings_page' );