<?php
/**
 * Published year field for Posts and Publications
 * This function records fields for the acf.
 */
function register_custom_acf_fields_block_carousel() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
      'key' => 'group_carousel_de68765ba68',
      'title' => 'Component Carousel',
      'fields' => array(
        array(
          'key' => 'field_64df817725c05',
          'label' => 'Carousel',
          'name' => 'for_carousel_repeater',
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
          'button_label' => 'Add Row',
          'rows_per_page' => 20,
          'sub_fields' => array(
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
                'width' => '',
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
              'parent_repeater' => 'field_64df817725c05',
            ),
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
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'maxlength' => '',
              'placeholder' => 'Enter your title here',
              'prepend' => '',
              'append' => '',
              'parent_repeater' => 'field_64df817725c05',
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
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'maxlength' => '',
              'placeholder' => 'Enter your subtitle here',
              'prepend' => '',
              'append' => '',
              'parent_repeater' => 'field_64df817725c05',
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
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'maxlength' => '',
              'rows' => '',
              'placeholder' => 'Enter your description here',
              'new_lines' => '',
              'parent_repeater' => 'field_64df817725c05',
            ),
            array(
              'key' => 'field_for_card_link',
              'label' => 'Card Link',
              'name' => 'for_card_link',
              'aria-label' => '',
              'type' => 'url',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'parent_repeater' => 'field_64df817725c05',
            ),
          ),
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'block',
            'operator' => '==',
            'value' => 'for/carousel',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
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

add_action( 'init', 'register_custom_acf_fields_block_carousel' );