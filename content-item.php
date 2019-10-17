<?php

$cats = get_the_category();
$cat_list = wp_list_pluck( $cats, 'name' );
$label = 'Blog';
if (in_array('Audio', $cat_list)) {
    $label   = 'Audio';
} elseif (in_array('Video', $cat_list)) {
    $label   = 'Video';
} elseif (is_amp()) {
    $label   = $cat_list[0];
} else {
    $label   = $cat_list[0];
}

$args = array(
    'id'            => get_the_ID(),
    'url'           => get_permalink(),
    'title'         => get_the_title(),
    'description'   => trim(substr(get_the_excerpt(), 0,160)).'...',
    'image'         => get_feature_image_url( get_the_ID(), 'large' ),
    'author'        => '',
    'pub_date'      => get_the_date( 'l j F Y' ),
    'label'         => $label
);

echo display_card( $args );

