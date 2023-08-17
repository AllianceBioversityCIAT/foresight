<?php
/**
 * Cards vertical block template.
 *
 * @param array $block The block settings and attributes.
 */

$args = [];

// Load values and assign defaults.
$image_ID = get_field( 'for_card_image' );
$card_title = !empty(get_field( 'for_card_title' )) ? get_field( 'for_card_title' ) : 'Enter your title here';
$card_subtitle = !empty(get_field( 'for_card_subtitle' )) ? get_field( 'for_card_subtitle' ) : 'Enter your subtitle here';
$card_description = !empty(get_field( 'for_card_description' )) ? get_field( 'for_card_description' ) : 'Enter your description here';
$card_link = get_field( 'for_card_link' );

// Create id attribute allowing for custom "anchor" value.
$args['id'] = 'card-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'container-card';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$args['classes'] = $classes;

if ( ! empty( $card_link ) && !is_admin() ) {
  ?>
    <a href="<?php echo $card_link; ?>">
  <?php
}
?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="grid grid-cols-2 shadow-lg <?php echo esc_attr( $args['classes'] ); ?>">
  <div class="col-span-1 max-md:col-span-2">
    <?php echo wp_get_attachment_image( $image_ID, 'full', '', array( 'class' => 'w-full h-full min-h-full min-h-[371px] max-md:min-h-full max-md:h-60 object-cover object-top' ) ); ?>
    <!-- <image class="w-full h-full min-h-[371px] max-md:min-h-full max-md:h-60 object-fill object-center" src="{{theme.link}}/static/images/slide1.jpeg" /> -->
  </div>
  <div class="col-span-1 max-md:col-span-2 bg-white px-8 pt-16 border-y border-r max-md:border-l border-[#E8E7E8] border-solid max-md:pt-10 pb-20 max-md:pb-8 flex flex-col gap-y-4 justify-center">
    <h5 class="text-xl text-dark font-bold mb-7 max-md:mb-2">
      <?php echo esc_html( $card_subtitle ); ?>
    </h5>
    <h4 class="text-3xl max-md:text-xl text-dark font-bold">
      <?php echo esc_html( $card_title ); ?>
    </h4>
    <div>
      <p class="text-base">
        <?php echo esc_html( $card_description ); ?>
      </p>
    </div>
  </div>
</div>

<?php

if ( ! empty( $card_link ) ) {
  echo '</a>';
}