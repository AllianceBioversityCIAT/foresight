<?php
/**
 * Published year field for Posts and Publications
 * This function records fields for the acf.
 */
function register_custom_acf_fields_hero_image() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
			[
				'key' => 'group_hero_image',
				'title' => 'Header Image',
				'fields' => [
					[
						'key' => 'field_hero_image',
						'label' => '',
						'name' => 'hero_image',
						'type' => 'image',
						'instructions' => 'Select an image to display as a cover on the header <b>(1920 x 946]</b> px',
						'required' => 0,
						'conditional_logic' => 0,
						'return_format' => 'url',
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