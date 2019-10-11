<?php

$cats = get_the_category();
$cat_list = wp_list_pluck( $cats, 'name' );

if (in_array('Audio', $cat_list)) {
    $label   = 'Audio';
} elseif (in_array('Video', $cat_list)) {
    $label   = 'Video';
} elseif (is_amp()) {
    $label   = $cat_list[0];
} else {
    $label   = 'Blog';
}

$image = get_feature_image_url( get_the_ID(), 'medium', true );
$title   = get_the_title();
$url     = get_permalink();
$excerpt = trim(substr(get_the_excerpt(), 0,160)).'...';
$date    = '';
$id      = get_the_ID();

echo display_card( $id, $url, $title, $excerpt, $image, $date, $label );

