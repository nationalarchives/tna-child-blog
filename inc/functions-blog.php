<?php
/**
 * Blog functions
 *
 */

// Dequeue parent styles for re-enqueuing in the correct order
function dequeue_parent_style()
{
	wp_dequeue_style('tna-styles');
	wp_deregister_style('tna-styles');
}

// Enqueue styles in correct order
function tna_child_styles()
{
	wp_register_style('tna-parent-styles', get_template_directory_uri() . '/css/base-sass.css.min', array(),
		EDD_VERSION, 'all');
	wp_register_style('tna-child-styles', get_stylesheet_directory_uri() . '/style.css', array(), '0.1', 'all');
	wp_enqueue_style('tna-parent-styles');
	wp_enqueue_style('tna-child-styles');
}

function get_blog_image_caption( $caption, $url='' ) {

	if (!empty($caption)) { ?>
		<div class="feature-img-caption img-caption-top">
			<button class="eye_caption">&nbsp;</button>
			<div class="image_caption_back">
				<span class="clearfix"><?php echo $caption; ?></span>
				<?php if ($url) { ?>
				<a href="<?php echo $url ?>" target="_blank">
						View in the image library
				</a>
				<?php } ?>
			</div>
		</div>
	<?php }
}

function blog_sidebar_widgets() {
	register_sidebar( array(
		'name' => 'Sidebar' ,
		'id' => 'blog-sidebar',
		'description' => __( 'Appears on posts and pages' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="sidebar-header"><h2>',
		'after_title' => '</h2></div><div class="sidebar-content clearfix">',
	) );
}
