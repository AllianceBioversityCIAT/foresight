<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_page_contact() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group( [
				'key'                   => 'group_page_contact',
				'title'                 => 'Page Contact',
				'fields'                => [
					[
						'key'               => 'field_contact_page_tab_content',
						'name'              => 'contact_page_tab_content',
						'label'             => 'Section Content',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'           => 'field_contact_title_cell_phone',
						'label'         => 'Contact phone number',
						'name'          => 'contact_title_cell_phone',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'           => 'field_contact_title_email',
						'label'         => 'Contact Email',
						'name'          => 'contact_title_email',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'           => 'field_contact_form_placeholder_full_name',
						'label'         => 'Placeholder Full Name.',
						'name'          => 'contact_form_placeholder_full_name',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'           => 'field_contact_form_placeholder_email',
						'label'         => 'Placeholder Email.',
						'name'          => 'contact_form_placeholder_email',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'           => 'field_contact_form_placeholder_cell_phone',
						'label'         => 'Placeholder Cell Phone.',
						'name'          => 'contact_form_placeholder_cell_phone',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'           => 'field_contact_form_placeholder_description',
						'label'         => 'Placeholder Description.',
						'name'          => 'contact_form_placeholder_description',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'           => 'field_contact_form_button_title',
						'label'         => 'Button Title.',
						'name'          => 'contact_form_button_title',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '',
					],
					[
						'key'          => 'field_contact_sending_email_repeater',
						'label'        => 'Form recipients',
						'name'         => 'contact_sending_email_repeater',
						'type'         => 'repeater',
						'instructions' => '',
						'required'     => 1,
						'min'          => 1,
						'layout'       => 'block',
						'button_label' => 'Add New',
						'sub_fields'   => [
							[
								'key'           => 'field_contact_sending_email',
								'label'         => 'Email',
								'name'          => 'contact_sending_email',
								'type'          => 'text',
								'required'      => 0,
							],
						],
					],
					[
						'key'               => 'field_contact_page_tab_email',
						'name'              => 'contact_page_tab_email',
						'label'             => 'Acknowledgement Email',
						'type'              => 'tab',
						'instructions'      => 'Response to client',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'           => 'field_contact_email_subject',
						'label'         => 'Subject',
						'name'          => 'contact_email_subject',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => '¡Welcome to CIAT Foresight!',
					],
					[
						'key'           => 'field_contact_email_greetings',
						'label'         => 'Greetings',
						'name'          => 'contact_email_greetings',
						'type'          => 'text',
						'required'      => 1,
						'wrapper'       => [
							'width' => '50',
						],
						'default_value' => 'Hi',
					],
					[
						'key'          => 'field_contact_email_description',
						'label'        => 'Email Description',
						'name'         => 'contact_email_description',
						'required' => 1,
						'type'     => 'textarea',
						'wrapper'  => [
							'width' => '50',
						],
						'rows'     => '2',
					],
					
				],
				'location'              => [
					[
						[
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-contact.php',
						]
					]
				],
				'menu_order'            => 0,
				'position'              => 'acf_after_title',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => [
					'the_content'
				],
				'active'                => 1,
			]
		);
	}
}

add_action( 'init', 'register_custom_acf_fields_page_contact' );
