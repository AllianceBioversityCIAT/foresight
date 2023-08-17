<?php
/**
 * Static Page
 * This function records fields for the acf.
 */
function register_custom_acf_fields_hero_image() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
			[
				'key' => 'group_hero_image',
				'title' => 'Options Header',
				'fields' => [
					[
						'key' => 'field_hero_image',
						'label' => 'Hero Image',
						'name' => 'hero_image',
						'type' => 'image',
						'instructions' => 'Select an image to display as a cover on the header <b>(1920 x 946]</b> px',
						'required' => 0,
						'conditional_logic' => 0,
						'return_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					],
					[
						'key'           => 'field_hero_title',
						'label'         => 'Hero Title',
						'name'          => 'hero_title',
						'type'          => 'text',
						'required'      => 0,
						'placeholder'	=> 'Resource',
						'wrapper'           => [
						  'width' => '50',
						  'class' => '',
						  'id'    => '',
						],
						'default_value'     => '',
					  ],
				],
				'location' => [
					[
						[
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'page',
						],
					],
					[
						[
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
						],
					],
				],
				'menu_order' => 0,
				'position' => 'side',
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

add_action( 'init', 'register_custom_acf_fields_hero_image' );