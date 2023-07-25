<?php
/**
 * Functions related to API REST in WordPress
 *
 * @package foresight
 */


function foresight_register_api_rest(){
	register_rest_route( 'ciat/v3', '/location/', array(
		'methods' => 'GET',
		'callback' => 'get_iplocation',
	  ) );
}

add_action( 'rest_api_init', 'foresight_register_api_rest' );


/**
 * Get country by IP using https://api.iplocation.net/
 *
 * @param WP_REST_Request $request Classes for the body element.
 * @return String
 */
function get_iplocation( WP_REST_Request $request ) {
	$ip 		=	$_SERVER['REMOTE_ADDR'];
	$response 	=	wp_remote_get( 'https://api.iplocation.net/?ip='.$ip );

	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		$body    = json_decode($response['body']);
	}

	return new WP_REST_Response( $body, 200 );
  
}
