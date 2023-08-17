<?php
/**
 * Button block template.
 *
 * @param array $block The block settings and attributes.
 */

$args = [];

// Load values and assign defaults.
$button_title = !empty(get_field( 'for_title_button' )) ? get_field( 'for_title_button' ) : 'Enter your title here or leave blank';
$button_link = get_field( 'for_button_link' );
$button_style = get_field( 'for_button_style' );
$button_align_desktop = get_field( 'for_button_aling_desktop' );
$button_align_mobile = get_field( 'for_button_aling_mobile' );
$target = get_field( 'for_button_target' );

// Create id attribute allowing for custom "anchor" value.
$args['id'] = 'for-button-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = '';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$args['classes'] = $classes;

?>

<div class="<?php echo esc_attr( $button_align_desktop ); ?> max-md:<?php echo esc_attr( $button_align_mobile ); ?>">
  <a href="<?php echo $button_link; ?>" class="<?php echo esc_attr( $button_style['value'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
    <?php echo esc_html( $button_title ); ?>
  </a>
</div>