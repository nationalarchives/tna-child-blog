<?php

require_once 'inc/functions-blog.php';
require_once 'inc/functions-admin.php';


add_action('wp_enqueue_scripts', 'dequeue_parent_style', 9999);
add_action('wp_head', 'dequeue_parent_style', 9999);
add_action('wp_enqueue_scripts', 'tna_child_styles');
add_action( 'admin_menu', 'tna_blog_menu' );


// Change date format - WP dashboard -> Settings -> General -> Date Format -> Custom = 'D j M Y'

function disable_comment_url($fields) {
	unset($fields['url']);
	return $fields;
}
add_filter('comment_form_default_fields','disable_comment_url');
