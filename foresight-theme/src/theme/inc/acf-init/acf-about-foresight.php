<?php
/** 
 * About Foresight Page
 * This function records fields for the acf.
 */

function register_custom_acf_fields_section_about_us() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
			[
				'key'                   => 'group_about_us',
				'title'                 => 'Settings',
				'fields'                => [
					[
						'key'               => 'field_about_us_tab_1',
						'label'             => 'Content',
						'name'              => 'about_us_tab_1',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_about_subtitle',
						'label'             => 'SubTitle',
						'name'              => 'about_subtitle',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '100',
						],
					],
					[
						'key'               => 'field_this_is_foresight',
						'label'             => 'This is Foresight',
						'name'              => 'this_is_foresight',
						'type'              => 'wysiwyg',
						'instructions'      => 'Write the content according to your preference, you can use html',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '50',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					],
					[
						'key'               => 'field_featured_content',
						'label'             => 'Featured content',
						'name'              => 'featured_content',
						'type'              => 'wysiwyg',
						'instructions'      => 'Write the content according to your preference, you can use html',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '50',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					],
					[
						'key'               => 'field_about_us_tab_2',
						'label'             => 'CG Foresight offer',
						'name'              => 'about_us_tab_2',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_cg_title',
						'label'             => 'Title',
						'name'              => 'cg_title',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '30',
						],
					],
					[
						'key'               => 'field_what_does_cg_foresight_offer',
						'label'             => 'What does CG Foresight offer?',
						'name'              => 'what_does_cg_foresight_offer',
						'type'              => 'wysiwyg',
						'instructions'      => 'Write the content according to your preference, you can use html',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '70',
						],
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					],
					[
						'key'               => 'field_offers',
						'label'             => 'Offers',
						'name'              => 'offers',
						'type'              => 'repeater',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'collapsed'         => '',
						'min'               => 0,
						'max'               => 0,
						'layout'            => 'block',
						'button_label'      => '',
						'sub_fields'        => [
							[
								'key'               => 'field_offer_icon',
								'label'             => 'Offer icon',
								'name'              => 'offer_icon',
								'type'              => 'image',
								'instructions'      => 'Select image (48 x 48) px',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '50',
								],
								'return_format'     => 'array',
								'preview_size'      => 'thumbnail',
								'library'           => 'all',
								'min_width'         => 48,
								'min_height'        => 48,
								'min_size'          => '',
								'max_width'         => 150,
								'max_height'        => 150,
								'max_size'          => '',
								'mime_types'        => 'jpg,png,jpeg,svg',
							],
							[
								'key'               => 'field_offer_label',
								'label'             => 'Offer label',
								'name'              => 'offer_label',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '50',
									'class' => '',
									'id'    => '',
								],
								'default_value'     => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '300',
							],
						],
					],
				],
				'location'              => [
					[
						[
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-about-foresight.php',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'acf_after_title',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => [
					0 => 'the_content',
					1 => 'excerpt',
					2 => 'discussion',
					3 => 'comments',
					4 => 'revisions',
					5 => 'format',
					6 => 'page_attributes',
					7 => 'featured_image',
					8 => 'send-trackbacks',
				],
				'active'                => true,
				'description'           => '',
			]

		);
	}
}

add_action( 'init', 'register_custom_acf_fields_section_about_us' );
