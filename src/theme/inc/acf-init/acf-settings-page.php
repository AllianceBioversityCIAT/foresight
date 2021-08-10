<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_settings_page() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
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
