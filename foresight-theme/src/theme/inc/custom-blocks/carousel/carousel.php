<?php
/**
 * Carousel vertical block template.
 *
 * @param array $block The block settings and attributes.
 */

$args = [];

// Load values and assign defaults.
$carousel_repeater = get_field( 'for_carousel_repeater' );

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


foreach( $carousel_repeater as $key => $val ) {

  if ($key === array_key_first($carousel_repeater) && !is_admin()) {
    ?>
      <div class="caroulse-full-container relative">
        <div class="for-carousel-slick carousel-full-slick component-carousel">
    <?php
  }

  ?>
  <div>
    <div class="grid grid-cols-2 px-8 <?php echo esc_attr( $args['classes'] ); ?>">
      <div class="col-span-1 max-md:col-span-2">
      <?php echo wp_get_attachment_image( $val['for_card_image'], 'full', '', array( 'class' => 'w-full h-full min-h-full min-h-[371px] max-md:min-h-full max-md:h-60 object-cover object-top' ) ); ?>
      </div>
      <div class="col-span-1 max-md:col-span-2 bg-white border-y border-r max-md:border-l border-[#E8E7E8] border-solid px-8 py-16 max-md:pt-10 max-md:pb-8 flex flex-col gap-y-4 justify-center">
        <h5 class="text-xl text-dark font-bold mb-7 max-md:mb-2">
          <?php echo esc_html( $val['for_card_title'] ); ?>
        </h5>
        <h4 class="text-3xl max-md:text-xl text-dark font-bold">
          <?php echo esc_html( $val['for_card_subtitle'] ); ?>
        </h4>
        <div>
          <p class="text-base">
            <?php echo esc_html( $val['for_card_description'] ); ?>
          </p>
        </div>
        <?php
          if ( ! empty( $val['for_card_link'] ) ) {
            ?>
              <div class="text-left mt-4 max-md:text-center">
                <a href="<?php echo $val['for_card_link']; ?>" class="btn-primary-large" target="_blank">
                  READ MORE
                </a>
              </div>
            <?php
          }
        ?>

      </div>
    </div>
  </div>
<?php

  if ($key === array_key_last($carousel_repeater) && !is_admin()) {
    ?>

      </div>
      
      <div class="caroulse-full-prev absolute max-md:!hidden">
        <svg width="34" height="30" viewBox="0 0 34 30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M-3.68582e-05 14.7422C-3.67394e-05 13.3831 1.01693 12.2852 2.36023 12.2852L25.6366 12.2852L17.6375 4.19231C16.6888 3.23253 16.6888 1.67769 17.6375 0.717913C18.1156 0.238024 18.7379 -1.32825e-06 19.3602 -1.27384e-06C19.9826 -1.21944e-06 20.6034 0.239943 21.0769 0.719832L33.2198 13.005C34.1684 13.9648 34.1684 15.5196 33.2198 16.4794L21.0769 28.7645C20.1283 29.7243 18.5914 29.7243 17.6428 28.7645C16.6941 27.8048 16.6941 26.2499 17.6428 25.2901L25.6366 17.1992L2.36023 17.1992C1.01693 17.1992 -3.6977e-05 16.1012 -3.68582e-05 14.7422Z" fill="#000000"/>
        </svg>
      </div>
      <div class="caroulse-full-next absolute max-md:!hidden">
        <svg width="34" height="30" viewBox="0 0 34 30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M-3.68582e-05 14.7422C-3.67394e-05 13.3831 1.01693 12.2852 2.36023 12.2852L25.6366 12.2852L17.6375 4.19231C16.6888 3.23253 16.6888 1.67769 17.6375 0.717913C18.1156 0.238024 18.7379 -1.32825e-06 19.3602 -1.27384e-06C19.9826 -1.21944e-06 20.6034 0.239943 21.0769 0.719832L33.2198 13.005C34.1684 13.9648 34.1684 15.5196 33.2198 16.4794L21.0769 28.7645C20.1283 29.7243 18.5914 29.7243 17.6428 28.7645C16.6941 27.8048 16.6941 26.2499 17.6428 25.2901L25.6366 17.1992L2.36023 17.1992C1.01693 17.1992 -3.6977e-05 16.1012 -3.68582e-05 14.7422Z" fill="#000000"/>
        </svg>
      </div>
    </div>

    <?php
  }
}

