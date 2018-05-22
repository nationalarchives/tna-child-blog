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
	wp_register_style('tna-child-sass', get_stylesheet_directory_uri() . '/css/blog.css.min', array(), '0.1', 'all');
	wp_enqueue_style('tna-parent-styles');
	wp_enqueue_style('tna-child-sass');
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

	$args = array(
		'has_published_posts' => true,
		'orderby' => 'display_name',
		'order'   => 'ASC'
	);
	$wp_user_query = new WP_User_Query( $args );
	$authors = $wp_user_query->get_results();

	foreach ( $authors as $author ) :

		if ( $author->ID !== 1 ) {

			echo '<option value="' . esc_html( $author->ID ) . '">' . esc_html( $author->display_name ) . '</option>';
		}

	endforeach;
}

function exclude_widget_categories($args) {
	$exclude = '1';
	$args['exclude'] = $exclude;
	return $args;
}

function add_featured_image_to_rss() {
	if ( function_exists( 'has_post_thumbnail' ) and has_post_thumbnail() ) {
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
		$mime_type = get_post_mime_type(get_post_thumbnail_id());
	} else {
		$featured_image = false;
	}
	if ( ! empty( $featured_image ) ) {
		$headers = get_headers($featured_image[0], 1);
		echo "\t" . '<enclosure url="' . $featured_image[0] . '" length="' . $headers["Content-Length"] . '" type="' . $mime_type . '" />' . "\n";
	}
}

function the_entry_meta( $args = '' ) {
	$defaults = array(
		'date'      => true,
		'authors'   => true,
		'cat'       => true,
		'comments'  => true,
		'home'      => false
	);

	$r = wp_parse_args( $args, $defaults );

	if ($r['date']) {
		the_time('l j F Y ');
		if ($r['home']) {
			echo '<br />';
		} else {
			echo ' <span>|</span> ';
		}
	}

	if ($r['authors']) {
		get_blog_authors();
		echo ' <span>|</span> ';
	}

	if ($r['cat']) {
		if (get_the_category()) {
			$cat_list = array();
			foreach ( ( get_the_category() ) as $category ) {
				if ( $category->cat_name != 'Uncategorized' ) {
					$cat_list[ $category->term_id ] = $category->name;
				}
			}
			$n = count( $cat_list );
			if ( $n != 0 ) {
				$i = 0;
				foreach ( $cat_list as $key => $value ) {
					echo '<a href="' . get_category_link( $key ) . '" title="' . sprintf( __( "View all posts in %s" ),
							$value ) . '" ' . '>' . $value . '</a>';
					if ( ++ $i != $n ) {
						echo ', ';
					}
				}
				echo ' <span>|</span> ';
			}
		}
	}

	if ($r['comments']) {
		comments_popup_link( 'Comment', '1 comment', '% comments' );
	}
}

function blog_content_urls_relative( $content ) {
	if ( is_ssl() ) {
		$site_url = str_replace( 'http:', 'https:', site_url() );
		return str_replace( $site_url, '', $content );
	}
	return $content;
}
