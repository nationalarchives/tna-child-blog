<?php

function is_amp() {
	if (get_option('blog_type') == 'amp') {
		return true;
	} else {
		return false;
	}
}

if ( is_amp() ) {
	add_action( 'wp_enqueue_scripts', 'tna_amp_scripts' );
	add_filter( 'body_class','amp_body_classes' );
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

function amp_body_classes( $classes ) {

	$classes[] = 'tna-amp';

	return $classes;

}
