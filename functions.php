<?php

require_once 'src/setThemeGlobals.php';
require_once 'src/identifyEnvironmentFromIP.php';
require_once 'src/blog-functions.php';

// For Breadcrumbs and URLs
$environment = identifyEnvironmentFromIP($_SERVER['SERVER_ADDR'], $_SERVER['REMOTE_ADDR']);
setThemeGlobals($environment);

add_action('wp_enqueue_scripts', 'dequeue_parent_style', 9999);
add_action('wp_head', 'dequeue_parent_style', 9999);
add_action('wp_enqueue_scripts', 'tna_child_styles');
