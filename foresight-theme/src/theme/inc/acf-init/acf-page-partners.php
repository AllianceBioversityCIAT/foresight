<?php
/**
 * Partners Page
 * This function records fields for the acf.
 */
function register_custom_acf_fields_page_partners() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
      'key' => 'group_64d53dcc8f7a2',
      'title' => 'Field Partners',
      'fields' => array(
        [
          'key'           => 'field_64d5413f6aasdd',
          'label'         => 'Sub Title',
          'name'          => 'sub_title_partner',
          'type'          => 'text',
          'required'      => 1,
        ],
        array(
          'key' => 'field_64d5413f6aaab',
          'label' => 'Logos',
          'name' => 'logos_repeater',
          'aria-label' => '',
          'type' => 'repeater',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'layout' => 'block',
          'min' => 3,
          'max' => 0,
          'collapsed' => '',
          'button_label' => 'Add partner',
          'sub_fields' => array(
            [
              'key'           => 'field_64d5413fa43sdd',
              'label'         => 'Partner Title',
              'name'          => 'title_partner',
              'type'          => 'text',
              'required'      => 1,
              'wrapper'           => [
                'width' => '50',
                'class' => '',
                'id'    => '',
              ],
            ],
            [
              'key' => 'field_64dbaaa1f1f38',
              'label' => 'partner link',
              'name' => 'partner_link',
              'aria-label' => '',
              'type' => 'url',
              'instructions' => '',
              'required' => 1,
              'conditional_logic' => 0,
              'wrapper'           => [
                'width' => '50',
                'class' => '',
                'id'    => '',
              ],
              'default_value' => '',
              'placeholder' => '',
            ],
            array(
              'key' => 'field_64d53dcd9bc26',
              'label' => 'Logo Partner',
              'name' => 'logo_partner',
              'aria-label' => '',
              'type' => 'image',
              'instructions' => '',
              'required' => 1,
              'conditional_logic' => 0,
              'return_format' => 'id',
              'library' => 'all',
              'preview_size' => 'medium',
              'parent_repeater' => 'field_64d5413f6aaab',
            ),
          ),
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_template',
            'operator' => '==',
            'value' => 'page-partners.php',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'acf_after_title',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => 0,
    ) );
	}
}

add_action( 'init', 'register_custom_acf_fields_page_partners' );