<?php

require_once get_template_directory() . '/theme/inc/class/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'register_required_plugins' );

/**
 * This function is used to require a plugin in WordPress
 */
function register_required_plugins() {

    $plugins = array(
        array(
            'name'             => 'WP Mail SMTP',
            'slug'             => 'wp-mail-smtp',
            'required'         => true,
            'force_activation' => true,
        ),
        array(
            'name'             => 'Simple Custom Post Order Settings',
            'slug'             => 'simple-custom-post-order',
            'required'         => true,
            'force_activation' => true,
        ),
        array(
            'name'             => 'Timber',
            'slug'             => 'timber-library',
            'required'         => true,
            'force_activation' => true,
        ),
    );

    tgmpa( $plugins );
}
