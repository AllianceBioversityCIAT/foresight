<?php
/**
 * Latest Post
 * This function records fields for the acf.
 */
function register_custom_acf_field_latest_posts() {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_64dbd730768e9',
	'title' => 'Latest Posts',
	'fields' => array(
      array(
        'key' => 'field_64dbd73167da3',
        'label' => 'Active latest posts?',
        'name' => 'active_latest_posts',
        'aria-label' => '',
        'type' => 'true_false',
        'instructions' => 'activate the last posts section for this page',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui_on_text' => 'Active',
        'ui_off_text' => 'Deactive',
        'ui' => 1,
      ),
      array(
        'key' => 'field_64dbd880081b5',
        'label' => 'Section title',
        'name' => 'section_title_lp',
        'aria-label' => '',
        'type' => 'text',
        'instructions' => 'For example: Latest Post or All Stories',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_64dbd73167da3',
              'operator' => '==',
              'value' => '1',
            ),
          ),
        ),
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
        'key' => 'field_64dbda78631a9',
        'label' => 'Card number',
        'name' => 'card_number_lp',
        'aria-label' => '',
        'type' => 'text',
        'instructions' => 'Enter the number of cards to be displayed.',
        'required' => 1,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_64dbd73167da3',
              'operator' => '==',
              'value' => '1',
            ),
          ),
        ),
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 6,
        'maxlength' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_64dbdada6297f',
        'label' => 'Search',
        'name' => 'search_lp',
        'aria-label' => '',
        'type' => 'true_false',
        'instructions' => 'check if it requires a search engine for the posts',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_64dbd73167da3',
              'operator' => '==',
              'value' => '1',
            ),
          ),
        ),
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 0,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
        ),
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
        ),
      ),
      array(
        array(
          'param' => 'page_type',
          'operator' => '!=',
          'value' => 'front_page',
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

add_action( 'acf/include_fields', 'register_custom_acf_field_latest_posts' );