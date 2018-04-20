<?php

if ( get_option('blog_type') == 'amp' ) {
	define( 'AMP', true );
} else {
	define( 'AMP', false );
}

if ( AMP ) {
	add_action( 'wp_enqueue_scripts', 'tna_amp_scripts' );
}

function tna_amp_scripts() {
	wp_register_script( 'jwplayer-js', get_stylesheet_directory_uri() . '/js/jwplayer.js', array(), '1.4.4', false );
	wp_register_script( 'jwplayer-key-js', get_stylesheet_directory_uri() . '/js/jwplayer-key.js', array(), '1.4.4', false );
	wp_enqueue_script( 'jwplayer-js' );
	wp_enqueue_script( 'jwplayer-key-js' );
}

function media_duration( $values ) {

	if ( $values[0] ) {
		return 'Duration '.$values[0];
	} else {
		return '';
	}
}

function media_file( $values ) {

	if ( $values[0] ) {
		return $values[0];
	} else {
		return '';
	}
}

function relative_path( $url ) {
	return str_replace( site_url(), '', $url );
}