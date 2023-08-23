<?php

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */


/** REGISTERING ACF BLOCKS  **/

/**
 * Load Blocks
 */
function cwp_acf_load_blocks() {

  // ADD MORE CUSTOM BLOCKS NAMES HERE
  $custom_gutenberg_blocks = array(
    array('folder' => 'cards-vertical', 'block' => 'cards-vertical'),
    array('folder' => 'button', 'block' => 'button'),
    array('folder' => 'carousel', 'block' => 'carousel'),
    array('folder' => 'cards-grid', 'block' => 'cards-grid'),
    // 'my-first-custom-ss-block',
  );

  ##### NO NEED TO CHANGE, THIS WORKS AUTOMATICALLY, FOR NEW BLOCKS JUST FOLLOW THE STEPS ABOVE

  foreach ($custom_gutenberg_blocks as $key => $gutenberg_block) {

    // ACF BLOCKS Block
    register_block_type(__DIR__ . '/' . $gutenberg_block['folder'] . '/block.json');
  }

	// // Optional - register stylesheet if using Style Method 2 from above
	// wp_register_style( 'block-tip', get_template_directory_uri() . '/blocks/tip/style.css' );
}
add_action( 'init', 'cwp_acf_load_blocks' );

/**
 * Filters the default array of categories for block types.
 */
function block_categories( $categories, $post) {
  
  $customCategories = array(
    array(
      'slug'	=> 'foresight',
      'title' => 'Blocks Foresight'
    ),
  );
  
  return array_merge($customCategories, $categories);
}

add_filter('block_categories_all', 'block_categories', 10, 2);