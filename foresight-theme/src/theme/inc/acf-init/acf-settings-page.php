<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_settings_page() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		$log_clarisa = get_transient( 'log_clarisa' );
		$log_zotero  = get_transient( 'log_zotero' );

		if( !empty($log_clarisa) ){
			$log_clarisa = "<b>Last update: </b>" . $log_clarisa[ 'date' ] . "<br>" .
			"<h3>SDGs</h3>" .
			"<b>Total Imported Items: </b>" . $log_clarisa[ 'sdg_count' ] ?? '0' . "<br>" .
			"<b>Total Updated Items: </b>" . $log_clarisa[ 'sdg_count_updated' ] . "<br>" .
			"<b>Clarisa Response: </b>" . json_encode( $log_clarisa[ 'sdg_response' ] ) . '<br>' .
			"<b>Wordpress Response: </b>" . json_encode( $log_clarisa[ 'sdg_insert_term' ] ) . '<br>' .
			"<h3>Impact Areas</h3>" .
			"<b>Total Imported Items: </b>" . $log_clarisa[ 'impact_areas_count' ] . "<br>" .
			"<b>Total Updated Items: </b>" . $log_clarisa[ 'impact_areas_count_updated' ] . "<br>" .
			"<b>Clarisa Response: </b>" . json_encode( $log_clarisa[ 'impact_areas_response' ] ) . '<br>' .
			"<b>Wordpress Response: </b>" . json_encode( $log_clarisa[ 'impact_areas_insert_term' ] ) . '<br>' .
			"<h3>Regions</h3>" .
			"<b>Total Imported Items: </b>" . $log_clarisa[ 'regions_count' ] . "<br>" .
			"<b>Total Updated Items: </b>" . $log_clarisa[ 'regions_count_updated' ] . "<br>" .
			"<b>Clarisa Response: </b>" . json_encode( $log_clarisa[ 'regions_response' ] ) . '<br>' .
			"<b>Wordpress Response: </b>" . json_encode( $log_clarisa[ 'regions_insert_term' ] ) . '<br>';
		}

		if( !empty($log_zotero) ){
			$log_zotero = "<b>Last update: </b>" . $log_zotero[ 'date' ] . "<br><br>" .
			"<ul>" . $log_zotero[ 'zotero_count' ] . "</ul>" .
			"<b>Zotero Response: </b>" . json_encode( $log_zotero[ 'zotero_response' ] ) . '<br>' .
			"<b>Wordpress Log: </b>" . $log_zotero[ 'zotero_wp_conflicts' ] . '';
		}

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
						'key'      => 'field_zotero_api_group_id',
						'label'    => 'Group ID',
						'name'     => 'zotero_api_group_id',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '33',
						],
					],
					[
						'key'          => 'field_zotero_api_url',
						'label'        => 'Base URL',
						'name'         => 'zotero_api_url',
						'type'         => 'text',
						'required'     => 0,
						'instructions' => 'Base connection URL',
						'wrapper'      => [
							'width' => '25',
						],
					],
					[
						'key'          => 'field_zotero_api_collections',
						'label'        => 'Collections',
						'name'         => 'zotero_api_collections',
						'type'         => 'text',
						'required'     => 0,
						'instructions' => 'Add multiple collection IDs separated by commas',
						'wrapper'      => [
							'width' => '25',
						],
					],
					[
						'key'          => 'field_zotero_wp_category_id',
						'label'        => 'Category',
						'name'         => 'zotero_wp_category_id',
						'type'         => 'taxonomy',
						'taxonomy'     => 'category',
						'add_term'     => 0,
						'field_type'   => 'select',
						'required'     => 0,
						'instructions' => 'Default category ID Wordpress',
						'wrapper'      => [
							'width' => '25',
						],
					],
					[
						'key'          => 'field_zotero_wp_author_id',
						'label'        => 'Author',
						'name'         => 'zotero_wp_author_id',
						'type'         => 'user',
						'required'     => 0,
						'instructions' => 'Default author Wordpress',
						'wrapper'      => [
							'width' => '25',
						],
					],
					[
						'key'               => 'field_import_zotero',
						'label'             => '',
						'name'              => 'button_import_zotero',
						'type'              => 'button',
						'value'             => 'Import Zotero Items',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '100',
							'class' => '',
							'id'    => '',
						],
					],
					[
						'key'               => 'field_zotero_log',
						'name'              => '',
						'type'              => 'message',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'message'           => $log_zotero,
						'esc_html'          => 0,
						'wrapper'           => [
							'width' => '100',
							'class' => '',
							'id'    => '',
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
						'key'               => 'field_import_list',
						'label'             => '',
						'name'              => 'button_import',
						'type'              => 'button',
						'value'             => 'Import All Control List',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '100',
							'class' => '',
							'id'    => '',
						],
					],
					[
						'key'               => 'field_list_control',
						'name'              => '',
						'type'              => 'message',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'message'           => $log_clarisa,
						'esc_html'          => 0,
						'wrapper'           => [
							'width' => '100',
							'class' => '',
							'id'    => '',
						],
					],
					[
						'key'               => 'field_login_tab',
						'label'             => 'Login',
						'name'              => 'login_tab',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_login_background_image',
						'label'             => 'Background Image',
						'name'              => 'login_background_image',
						'type'              => 'image',
						'instructions'      => 'Select an image to display as a cover on the front page (1920 x 946] px',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'  => [
							'width' => '50',
						],
						'return_format'     => 'array',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
						'mime_types'        => 'png,jpg,jpeg',
					],
					[
						'key'               => 'field_login_second_background_image',
						'label'             => 'Second Background Image',
						'name'              => 'login_second_background_image',
						'type'              => 'image',
						'instructions'      => 'Select an image to display as a cover on the front page (1920 x 946] px',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'  => [
							'width' => '50',
						],
						'return_format'     => 'array',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
						'mime_types'        => 'png,jpg,jpeg',
					],
					[
						'key'      => 'field_login_title',
						'label'    => 'Title',
						'name'     => 'login_title',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '50',
						],
					],
					[
						'key'      => 'field_login_sub_title',
						'label'    => 'Sub Title',
						'name'     => 'login_sub_title',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '50',
						],
					],
					[
						'key'           => 'field_login_description',
						'label'         => 'Description',
						'name'          => 'login_description',
						'type'          => 'textarea',
						'required'      => 0,
						'default_value' => '',
						'placeholder'   => '',
						'maxlength'     => '',
						'rows'          => '4',
						'new_lines'     => '',
					],
					[
						'key'               => 'field_footer_tab',
						'label'             => 'Footer',
						'name'              => 'footer_tab',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_footer_company_image',
						'name'              => 'footer_company_image',
						'label'             => 'Footer Logo',
						'type'              => 'image',
						'instructions'      => 'Select image (176 × 170) px',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '50',
						],
						'return_format'     => 'array',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
						'mime_types'        => 'png,jpg,jpeg',
					],
					[
						'key' => 'field_footer_company_text',
						'label' => 'Description',
						'name' => 'footer_company_text',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '50',
						],
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 0,
						'delay' => 0,
					],
					[
						'key'      => 'field_footer_title_newsletter',
						'label'    => 'Newsletter Title',
						'name'     => 'footer_title_newsletter',
						'type'     => 'text',
						'required' => 0,
						'wrapper'  => [
							'width' => '50',
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
