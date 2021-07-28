<?php
/**
 * This function records fields for the acf.
 */
function register_custom_acf_fields_settings_page() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
            [
                'key' => 'group_foresight_settings',
                'title' => 'Foresight',
                'fields' => [
                    [
                        'key' => 'field_settings_tab_1',
                        'label' => 'Contact',
                        'name' => '',
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
                        'endpoint' => 1,
                    ],
                    [
                        'key' => 'field_settings_contact_us_address',
                        'name' => 'contact_us_address',
                        'label' => 'Address',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_settings_contact_us_phone',
                        'name' => 'contact_us_phone',
                        'label' => 'Phone',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_settings_contact_us_email',
                        'name' => 'contact_us_email',
                        'label' => 'Email',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'theme-general-settings',
                        ],
                    ],
                ],
                'menu_order' => 0,
                'position' => 'normal',
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

add_action( 'init', 'register_custom_acf_fields_settings_page' );
