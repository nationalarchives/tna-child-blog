<?php
if ( is_amp() && function_exists('get_post_custom_values') ) {
	$release  = get_post_custom_values( 'releaseDate' );
	$producer = get_post_custom_values( 'producer' );
	$source   = get_post_custom_values( 'source' );
	$director = get_post_custom_values( 'director' );
	$sponsor  = get_post_custom_values( 'sponsor' );
	$credits  = array();
	if ( $release[0] ) {
		array_push( $credits, 'Release date: ' . $release[0] );
	}
	if ( $director[0] ) {
		array_push( $credits, 'Director: ' . $director[0] );
	}
	if ( $producer[0] ) {
		array_push( $credits, 'Producer: ' . $producer[0] );
	}
	if ( $source[0] ) {
		array_push( $credits, 'Source: ' . $source[0] );
	}
	if ( $sponsor[0] ) {
		array_push( $credits, 'Sponsor: ' . $sponsor[0] );
	}
	if ( $credits ) {
		$last = end( $credits );
		echo '<div class="media-credits"><p>';
		foreach ( $credits as $credit ) {
			echo $credit;
			if ( $credit !== $last ) {
				echo ' <span>|</span> ';
			}
		}
		echo '</p></div>';
	}
}
