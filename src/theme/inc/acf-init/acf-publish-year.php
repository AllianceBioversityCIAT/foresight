<?php
/**
 * Published year field for Posts and Publications
 * This function records fields for the acf.
 */
function register_custom_acf_fields_select_publish_year() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
			[
				'key' => 'group_select_publish_year',
				'title' => 'Published Year',
				'fields' => [
					[
						'key' => 'field_select_publish_year',
						'label' => '',
						'name' => 'publish_year',
						'type' => 'taxonomy',
						'instructions' => 'Select year',
						'required' => 0,
						'conditional_logic' => 0,
						'taxonomy' => 'publish-year',
						'field_type' => 'select',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 1,
						'load_terms' => 1,
						'return_format' => 'object',
						'multiple' => 0,
					],
				],
				'location' => [
					[
						[
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
						],
					],
					[
						[
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'publication',
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

add_action( 'init', 'register_custom_acf_fields_select_publish_year' );