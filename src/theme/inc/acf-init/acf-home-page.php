<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_section_home_page() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
            [
                'key' => 'group_home_page',
                'title' => 'Settings',
                'fields' => [
                    [
                        'key' => 'field_home_page_tab_1',
                        'label' => 'Header',
                        'name' => 'home_page_tab_1',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'placement' => 'top',
                        'endpoint' => 0,
                    ],
                    [
                        'key' => 'field_home_page_backgoud_image',
                        'label' => 'Background Image',
                        'name' => 'background_image',
                        'type' => 'image',
                        'instructions' => 'Select an image to display as a cover on the front page (1920 x 946] px',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => 'png,jpg',
                    ],
                    [
                        'key' => 'field_home_page_tab_2',
                        'label' => 'Participating CGIAR Centers',
                        'name' => 'home_page_tab_2',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'placement' => 'top',
                        'endpoint' => 0,
                    ],
                    [
                        'key' => 'field_home_page_participants_repeater',
                        'label' => 'Items',
                        'name' => 'items',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => [
                            [
                                'key' => 'field_home_page_participants_image',
                                'label' => 'Image logo',
                                'name' => 'image_logo',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'return_format' => 'array',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => 'png,jpg',
                            ],
                        ],
                    ],
                    [
                        'key' => 'field_home_page_tab_3',
                        'label' => 'Curated Search',
                        'name' => 'home_page_tab_3',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ],
                    [
                        'key' => 'field_home_page_curated_search_repeater',
                        'label' => 'Slider Items',
                        'name' => 'slider_items',
                        'type' => 'repeater',
                        'instructions' => 'Add slider items',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 20,
                        'layout' => 'block',
                        'button_label' => '',
                        'sub_fields' => [
                            [
                                'key' => 'field_home_page_term_cured',
                                'label' => 'Term Cured',
                                'name' => 'term_cured',
                                'type' => 'taxonomy',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '30',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'taxonomy' => 'post_tag',
                                'field_type' => 'select',
                                'allow_null' => 0,
                                'add_term' => 1,
                                'save_terms' => 0,
                                'load_terms' => 0,
                                'return_format' => 'object',
                                'multiple' => 0,
                            ],
                            [
                                'key' => 'field_home_page_term_image',
                                'label' => 'Term Image',
                                'name' => 'term_image',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '30',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'return_format' => 'id',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'min_width' => 150,
                                'min_height' => 150,
                                'min_size' => '',
                                'max_width' => 150,
                                'max_height' => 150,
                                'max_size' => '',
                                'mime_types' => 'jpg,png,jpeg',
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'page_type',
                            'operator' => '==',
                            'value' => 'front_page',
                        ],
                    ],
                ],
                'menu_order' => 0,
                'position' => 'acf_after_title',
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

add_action( 'init', 'register_custom_acf_fields_section_home_page' );