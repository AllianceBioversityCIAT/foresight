<?php
/**
 * Front Page
 * This function records fields for the acf.
 */
function register_custom_acf_fields_section_home_page() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
			[
				'key'                   => 'group_home_page',
				'title'                 => 'Settings',
				'fields'                => [	
					[
						'key'               => 'field_home_about_tab_2',
						'label'             => 'About Company',
						'name'              => 'home_page_tab_1',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_about_company_image',
						'name'              => 'about_company_image',
						'label'             => 'Image',
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
						'key' => 'field_about_company_text',
						'label' => 'Description',
						'name' => 'about_company_text',
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
						'media_upload' => 1,
						'delay' => 0,
					],
					[
						'key'               => 'field_home_page_tab_3',
						'label'             => 'Curated Search',
						'name'              => 'home_page_tab_3',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_home_page_curated_search_repeater',
						'label'             => 'Slider Items',
						'name'              => 'slider_items',
						'type'              => 'repeater',
						'instructions'      => 'Add slider items',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'collapsed'         => '',
						'min'               => 0,
						'max'               => 20,
						'layout'            => 'block',
						'button_label'      => '',
						'sub_fields'        => [
							[
								'key'               => 'field_home_page_term_cured',
								'label'             => 'Term Cured',
								'name'              => 'term_cured',
								'type'              => 'taxonomy',
								'instructions'      => '',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '30',
									'class' => '',
									'id'    => '',
								],
								'taxonomy'          => 'post_tag',
								'field_type'        => 'select',
								'allow_null'        => 0,
								'add_term'          => 0,
								'save_terms'        => 0,
								'load_terms'        => 0,
								'return_format'     => 'object',
								'multiple'          => 0,
							],
							[
								'key'               => 'field_home_page_term_image',
								'label'             => 'Term Image',
								'name'              => 'term_image',
								'type'              => 'image',
								'instructions'      => 'Select image (150 x 150) px',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '30',
									'class' => '',
									'id'    => '',
								],
								'return_format'     => 'id',
								'preview_size'      => 'thumbnail',
								'library'           => 'all',
								'min_width'         => 150,
								'min_height'        => 150,
								'min_size'          => '',
								'max_width'         => 150,
								'max_height'        => 150,
								'max_size'          => '',
								'mime_types'        => 'jpg,png,jpeg',
							],
						],
					],
					[
						'key'               => 'field_home_panels_info',
						'label'             => 'Info Panels',
						'name'              => 'home_panels_info',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					[
						'key'               => 'field_home_panels_repeater',
						'label'             => 'Panel Cards',
						'name'              => 'home_panels_repeater',
						'type'              => 'repeater',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'collapsed'         => '',
						'min'               => 0,
						'max'               => 0,
						'layout'            => 'block',
						'button_label'      => 'Add',
						'sub_fields'        => [
							[
								'key'               => 'field_home_panel_card_title',
								'name'              => 'home_panel_card_title',
								'label'             => 'Title',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '33.33',
								],
							],
							[
								'key'               => 'field_panel_card_image',
								'name'              => 'panel_card_image',
								'label'             => 'Image',
								'type'              => 'image',
								'instructions'      => 'Select image (360 × 260) px',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '33.33',
								],
								'return_format'     => 'array',
								'preview_size'      => 'thumbnail',
								'library'           => 'all',
								'mime_types'        => 'png,jpg,jpeg',
							],
							[
								'key' => 'field_home_panel_card_active_read_more',
								'label' => 'Active read more',
								'name' => 'active_read_more',
								'type' => 'true_false',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper'           => [
									'width' => '33.33',
								],
								'message' => '',
								'default_value' => 0,
								'ui' => 1,
								'ui_on_text' => 'Yes',
								'ui_off_text' => 'No',
							],
							[
								'key' => 'field_home_panel_card_text',
								'label' => 'Description',
								'name' => 'home_panel_card_text',
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
								'media_upload' => 1,
								'delay' => 0,
							],
							[
								'key' => 'field_home_panel_description_in_read_more',
								'label' => 'Description in read more',
								'name' => 'description_in_read_more',
								'type' => 'wysiwyg',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => [
									[
										[
											'field' => 'field_home_panel_card_active_read_more',
											'operator' => '==',
											'value' => '1',
										]
									]
								],
								'wrapper'           => [
									'width' => '50',
								],
								'default_value' => '',
								'tabs' => 'all',
								'toolbar' => 'full',
								'media_upload' => 1,
								'delay' => 0,
							],
						],
					],
					[
						'key'               => 'field_home_carousel_posts',
						'label'             => 'Carousel Posts',
						'name'              => 'home_carousel_posts',
						'type'              => 'tab',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'placement'         => 'top',
						'endpoint'          => 0,
					],
					array(
						'key' => 'field_carousel_title_posts',
						'label' => 'Title',
						'name' => 'for_carousel_title_posts',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => 'Enter your title here',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_carousel_button_posts',
						'label' => 'Title Button',
						'name' => 'for_carousel_button_posts',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_carousel_link_posts',
						'label' => 'Button Link',
						'name' => 'for_carousel_link_posts',
						'aria-label' => '',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
						),
					),
					array(
						'key' => 'field_carousel_posts_repeater',
						'label' => 'Carousel',
						'name' => 'for_carousel_posts_repeater',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'block',
						'pagination' => 0,
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Slide',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_for_card_title',
								'label' => 'Card Title',
								'name' => 'for_card_title',
								'aria-label' => '',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'maxlength' => '',
								'placeholder' => 'Enter your title here',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_carousel_posts_repeater',
							),
							array(
								'key' => 'field_for_card_subtitle',
								'label' => 'Card SubTitle',
								'name' => 'for_card_subtitle',
								'aria-label' => '',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'maxlength' => '',
								'placeholder' => 'Enter your subtitle here',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_carousel_posts_repeater',
							),
							array(
								'key' => 'field_for_card_image',
								'label' => 'Card Image',
								'name' => 'for_card_image',
								'aria-label' => '',
								'type' => 'image',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'id',
								'library' => 'all',
								'min_width' => '',
								'min_height' => '',
								'min_size' => '',
								'max_width' => '',
								'max_height' => '',
								'max_size' => '',
								'mime_types' => '',
								'preview_size' => 'medium',
								'parent_repeater' => 'field_carousel_posts_repeater',
							),
							array(
								'key' => 'field_for_card_description',
								'label' => 'Card Description',
								'name' => 'for_card_description',
								'aria-label' => '',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
									'class' => '',
									'id' => '',
								),
								'default_value' => 'Enter your description here',
								'maxlength' => '',
								'rows' => '',
								'placeholder' => '',
								'new_lines' => '',
								'parent_repeater' => 'field_carousel_posts_repeater',
							),
						),
					),
				],
				'location'              => [
					[
						[
							'param'    => 'page_type',
							'operator' => '==',
							'value'    => 'front_page',
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

		acf_add_local_field_group(
			[
				'key'                   => 'group_menu_items',
				'title'                 => 'Settings',
				'fields'                => [
					array(
						'key' => 'field_64cbd4437fd6e',
						'label' => 'Type Modal',
						'name' => 'type_modal',
						'aria-label' => '',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui_on_text' => 'Yes',
						'ui_off_text' => 'No',
						'ui' => 1,
					),
					array(
						'key' => 'field_64cd50f135ef9',
						'label' => 'Modal text',
						'name' => 'modal_text',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_64cbd4437fd6e',
									'operator' => '==',
									'value' => '1',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				],
				'location'              => [
					[
						[
							'param'    => 'nav_menu_item',
							'operator' => '==',
							'value'    => 'location/foresight-footer-menu',
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

add_action( 'init', 'register_custom_acf_fields_section_home_page' );
