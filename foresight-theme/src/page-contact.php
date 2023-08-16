<?php
/**
 * Template Name: Page - Contact
 *
 * @package foresight
 */

get_header();

if ( class_exists( 'Timber' ) ) {
	$id_page                 = get_the_ID();
	$context                 = Timber::context();
	$context[ 'post' ]       = new Timber\Post();
	$context[ 'social_menu' ] = new TimberMenu( 'foresight-social-menu' );
	$options_page            = get_fields( 'theme-general-settings' );

	if ( $_POST ) {
		$form_info     = $_POST;
		$token         = $form_info[ 'token' ];
		$action        = $form_info[ 'action' ];
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $options_page[ 'recaptcha_secret_key' ] . '&response=' . $token;
		$response      = wp_remote_get( $recaptcha_url );
		$arrResponse   = json_decode( wp_remote_retrieve_body( $response ) );

		if ( ( $arrResponse->success ) && ( $arrResponse->action === $action ) && ( $arrResponse->score >= $options_page[ 'recaptcha_score' ] ) ) {

			ob_start();
			$context[ 'contactInfo' ]     = $form_info;
			$context[ 'subjectUser' ]     = get_field( 'contact_email_subject', $id_page );
			$context[ 'greetingsUser' ]   = get_field( 'contact_email_greetings', $id_page );
			$context[ 'descriptionUser' ] = get_field( 'contact_email_description', $id_page );
			Timber::render( './view/email/contact-email-user.twig', $context );
			$message_user = ob_get_clean();
			$email_user   = $form_info[ 'email' ];
			$headers[]    = 'Content-Type: text/html; charset=UTF-8';
			$subject_user = $context[ 'subjectUser' ];

			$response_mail_user = wp_mail( $email_user, $subject_user, $message_user, $headers );

			ob_start();
			$context[ 'subjectDriven' ] = 'Contact us ' . get_bloginfo('name');
			$context[ 'webSiteTitle' ]  = get_the_title();
			$context[ 'webSiteLink' ]   = get_permalink();
			Timber::render( './view/email/contact-email-admin.twig', $context );
			$message             = ob_get_clean();
			$multiple_recipients = get_field( 'contact_sending_email_repeater', $id_page );
			$emails              = [];

			foreach ( $multiple_recipients as $email ) {
				array_push( $emails, $email[ 'contact_sending_email' ] );
			}

			$subject = $context[ 'subjectDriven' ];

			$response_mail_user = wp_mail( $emails, $subject, $message, $headers );
		} else {

			wp_redirect( get_permalink( $id_page ) );
			exit();
		}
	}


	Timber::render( './view/page/contact.twig', $context );

} else {
	echo '<h1>Timber plugin is required</h1>';
}

get_footer( 'secondary' );
