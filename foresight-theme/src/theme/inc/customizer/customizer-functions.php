<?php
/**
 * Functions Customizer.
 *
 * @package Cafeto_Theme.
 */

/**
 * This function serves to create an additional layer of hierarchy beyond the controls and sections by building a panel.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $panel_id Get the panel id.
 * @param $panel_title Get the panel title.
 */
function customize_add_panel( $wp_customize, $panel_id, $panel_title ) {

    $wp_customize->add_panel(
        $panel_id,
        array(
            'title' => esc_html__( $panel_title, SLUG_THEME ),
        )
    );
}

/**
 * This function creates a section to display custom driver content.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $panel_id Get the panel id.
 * @param $section_id Get the section id.
 * @param $section_title Get the section title.
 */
function customize_add_section( $wp_customize, $panel_id, $section_id, $section_title ) {

    $wp_customize->add_section(
        $section_id,
        array(
            'title' => esc_html__( $section_title, SLUG_THEME ),
            'panel' => $panel_id
        )
    );
}

/**
 * This function allows us to save default settings for controllers.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $setting_id Get the setting id.
 * @param $partial_id_selector Get the selector id.
 */
function customize_add_setting( $wp_customize, $setting_id, $partial_id_selector ) {

    $wp_customize->add_setting(
        $setting_id,
        array(
            'default' => customize_default_variables( $setting_id ),
        )
    );

    if ( $partial_id_selector !== '' ) {
        $wp_customize->selective_refresh->add_partial(
            $setting_id,
            array(
                'selector' => $partial_id_selector,
            )
        );
    }
}

/**
 * This function allows us to create a specific field to control the customization of the website.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $section_id Get the section id.
 * @param $setting_id Get the setting id.
 * @param $control_id Get the control id.
 * @param $control_title Get the control title.
 */
function customize_add_control_text( $wp_customize, $section_id, $setting_id, $control_id, $control_title ) {

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $control_id,
        array(
            'label'       => esc_html__( $control_title, SLUG_THEME ),
            'section'     => $section_id,
            'settings'    => $setting_id,
            'type'        => 'text',
            'input_attrs' => array(
                'class'       => $control_id.'-class',
                'placeholder' => esc_html__( 'Enter '.strtolower( $control_title ), SLUG_THEME ),
            ),
        )
    ) );
}

/**
 * This function allows us to create a specific field to control the customization of the website.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $section_id Get the section id.
 * @param $setting_id Get the setting id.
 * @param $control_id Get the control id.
 * @param $control_title Get the control title.
 */
function customize_add_control_textarea( $wp_customize, $section_id, $setting_id, $control_id, $control_title ) {

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $control_id,
        array(
            'label'       => esc_html__( $control_title, SLUG_THEME ),
            'section'     => $section_id,
            'settings'    => $setting_id,
            'type'        => 'textarea',
            'input_attrs' => array(
                'class'       => $control_id.'-class',
                'placeholder' => esc_html__( 'Enter '.strtolower( $control_title ), SLUG_THEME ),
            ),
        )
    ) );
}

/**
 * This function allows us to create a specific field to control the customization of the website.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $section_id Get the section id.
 * @param $setting_id Get the setting id.
 * @param $control_id Get the control id.
 * @param $control_title Get the control title.
 */
function customize_add_control_image( $wp_customize, $section_id, $setting_id, $control_id, $control_title ) {
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        $control_id,
        array(
            'label'         => esc_html__( $control_title, SLUG_THEME ),
            'section'       => $section_id,
            'settings'      => $setting_id,
            'button_labels' => array(
                'select'       => __( 'Select Image' ),
                'change'       => __( 'Change Image' ),
                'remove'       => __( 'Remove' ),
                'default'      => __( 'Default' ),
                'placeholder'  => __( 'No image selected' ),
                'frame_title'  => __( 'Select Image' ),
                'frame_button' => __( 'Choose Image' ),
            )
        )
    ) );
}

/**
 * This function allows us to create a specific field to control the customization of the website.
 *
 * @param $wp_customize Get the class wp_customize.
 * @param $section_id Get the section id.
 * @param $setting_id Get the setting id.
 * @param $control_id Get the control id.
 * @param $control_title Get the control title.
 */
function customize_add_control_color( $wp_customize, $section_id, $setting_id, $control_id, $control_title ) {

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $control_id,
        array(
            'label'       => esc_html__( $control_title, SLUG_THEME ),
            'section'     => $section_id,
            'settings'    => $setting_id,
            'type'        => 'color',
        )
    ) );
}
