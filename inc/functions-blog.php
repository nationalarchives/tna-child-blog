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

function tna_child_scripts()
{
	wp_register_script( 'bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js', array(), '3.3.2', true );
	wp_register_script( 'blog-js', get_stylesheet_directory_uri() . '/js/tna-child-blog.js', array(), '0.1', true );
	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_script( 'blog-js' );
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
	register_sidebar( array(
		'name' => 'Homepage' ,
		'id' => 'blog-homepage',
		'description' => __( 'Appears on homepage' ),
		'before_widget' => '<div class="col-md-6"><article id="%1$s" class="hompage-widget %2$s">',
		'after_widget' => '</div></article></div>',
		'before_title' => '<div class="entry-header"><h2>',
		'after_title' => '</h2></div><div class="entry-content clearfix">',
	) );
}

function get_blog_authors() {
	if ( function_exists( 'coauthors_posts_links' ) ) {
		coauthors_posts_links();
	} else {
		the_author_posts_link();
	}
}

function get_blog_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'display_name',
		'order'   => 'ASC'
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		if ( ! $post_count ) {
			continue;
		}
		?>

		<li>
			<a href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
				<?php echo get_the_author_meta( 'display_name', $contributor_id ); ?>
			</a>
			<?php printf( _n( '%d Article', '%d Articles', $post_count, 'tna-base' ), $post_count ); ?>
		</li>

		<?php
	endforeach;
}

