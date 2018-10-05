<?php
/*
 * Contextual linking prototype: Related posts
 * (Blog, AMP and Research Guides)
 * by Chris Bishop
 *
 */

function blog_check_result( $result ) {
	if ( is_wp_error( $result ) ) {
		$result = false;
	} elseif ( wp_remote_retrieve_response_code( $result ) == '404' ) {
		$result = false;
	} else {
		$result = true;
	}
	return $result;
}

function blog_get_html_content( $url ) {
	if ( ! class_exists( 'WP_Http' ) ) {
		include_once( ABSPATH . WPINC . '/class-http.php' );
	}
	$request = new WP_Http;
	$result  = $request->request( $url );
	if ( blog_check_result( $result ) ) {
		$content = $result['body'];
	} else {
		$content = null;
	}
	return $content;
}

function blog_get_meta_og_data( $url ) {
	if ( $url ) {
		$html_content = blog_get_html_content( $url );
		if ( $html_content ) {
			$data = array();
			$html = new DOMDocument();
			@$html->loadHTML( $html_content );
			$data['title']          = '';
			$data['description']    = '';
			$data['img'][0]         = get_stylesheet_directory_uri().'/img/card-thumb.jpg';
			$data['url']            = $url;
			$data['type']           = 'National Archives Blog';
			$i                      = 0;
			foreach ( $html->getElementsByTagName( 'meta' ) as $meta ) {
				if ( $meta->getAttribute( 'property' ) == 'og:title' ) {
					$title = $meta->getAttribute( 'content' );
					$title = str_replace('| The National Archives blog', '', $title);
					$title = str_replace('| The National Archives', '', $title);
					$data['title'] = $title;
				}
				if ( $meta->getAttribute( 'property' ) == 'og:description' ) {
					$data['description'] = $meta->getAttribute( 'content' );
				}
				if ( $meta->getAttribute( 'property' ) == 'twitter:image' ) {
					$data['img'][0] = $meta->getAttribute( 'content' );
				}
				if ( $meta->getAttribute( 'property' ) == 'og:image' ) {
					$data['img'][ $i ] = $meta->getAttribute( 'content' );
					$i ++;
				}
			}
			if ( strpos( $url, 'research-guides' ) !== false ) {
				$data['type'] = 'Research guide';
			}
			if ( strpos( $url, 'media.nationalarchives' ) !== false ) {
				$data['type'] = 'Archives Media Player';
			}
			return $data;
		}
	}
	return false;
}

function r_html( $id, $url, $img, $title, $type ) {

	$html = '
<div class="col-md-4 related-post parent-post-%s">
	<a href="%s">
	<div class="related-post-thumb" style="background-image: url(%s)"></div>
	<p><small>%s</small></p>
	<h4>%s</h4>
	</a>
</div>';

	return sprintf( $html, $id, $url, $img, $type, $title );
}


function display_recommended_content( $content ) {

	global $post;
	$recommended = '';
	delete_transient( 'recommended-'.$post->ID );
	$transient_recommended = get_transient( 'recommended-'.$post->ID );

	if ( !$transient_recommended ) {

		$content_links = array();
		$dom = new domDocument;
		@$dom->loadHTML($content);
		$dom->preserveWhiteSpace = false;
		$links = $dom->getElementsByTagName('a');
		foreach ($links as $link_obj)
		{
			$link = $link_obj->getAttribute('href');
			if ( strpos( $link, '.jpg' ) == false ) {
				if (
					strpos( $link, 'research-guides' ) !== false ||
					strpos( $link, 'media.nationalarchives' ) !== false ||
					strpos( $link, 'blog.nationalarchives' ) !== false
				) {
					if (
						(strpos( $link, 'research-guides' ) !== false && !preg_grep( '/research-guides/', $content_links)) ||
						(strpos( $link, 'media.nationalarchives' ) !== false && !preg_grep( '/media.nationalarchives/', $content_links)) ||
						(strpos( $link, 'blog.nationalarchives' ) !== false && !preg_grep( '/blog.nationalarchives/', $content_links))
					) {
						array_push( $content_links, $link );
					}
				}
			}
		}

		foreach ( $content_links as $url ) {

			$data = blog_get_meta_og_data( $url );

			$recommended .= r_html( $post->ID, $data['url'], $data['img'][0], $data['title'], $data['type'] );
		}

		$count = count($content_links);

		if ( $count < 3 ) {
			$n = 3 - $count;
			$related = blog_get_related_posts( $n );
			$relative = array();

			if ( $related ) {
				foreach ( $related as $key => $blog ) {
					foreach ( $blog as $item ) {

						$blog_id = $key;
						switch_to_blog( $blog_id );
						$image = '';
						if ( has_post_thumbnail( $item->ID ) ) {
							$thumb_id = get_post_thumbnail_id($item->ID);
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
							$image = $thumb_url_array[0];
							$relative['url'] = get_permalink($item->ID);
						}
						restore_current_blog();

						$relative['title']          = $item->post_title;
						$relative['img'][0]         = ( $image ) ? $image : get_stylesheet_directory_uri().'/img/card-thumb.jpg';
						$relative['type']           = ( strpos( $relative['url'], 'media.national' ) !== false ) ? 'Archives Media Player' : 'National Archives Blog' ;

						$recommended .= r_html( $post->ID, $relative['url'], $relative['img'][0], $relative['title'], $relative['type'] );
					}
				}
			}
		}

		set_transient( 'recommended-'.$post->ID, $recommended, DAY_IN_SECONDS );

		return $recommended;
	}

	return '<!-- transient_recommended -->' . $transient_recommended . '<!-- transient_recommended -->' ;
}

function blog_get_related_posts( $i = 1 ) {
	global $post;
	$id = $post->ID;

	$tag_ids = array();
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
	}

	if ( is_multisite() ) {
		$blog_list = get_sites();
		$related = array();

		if ($tag_ids) {
			foreach ($blog_list as $blog) {

				$blog_id = get_object_vars($blog)['blog_id'];

				switch_to_blog( $blog_id );

				$related[$blog_id] = get_posts(
					array(
						'tag__in' => $tag_ids,
						'numberposts'  => $i,
						'post__not_in' => array( $id )
					)
				);
				restore_current_blog();
			}
		} else {
			foreach ($blog_list as $blog) {

				$blog_id = get_object_vars($blog)['blog_id'];

				switch_to_blog( $blog_id );

				$related[$blog_id] = get_posts(
					array(
						'category__in' => wp_get_post_categories($id),
						'numberposts'  => $i,
						'post__not_in' => array( $id )
					)
				);
				restore_current_blog();
			}
		}

	} else {
		$related = get_posts(
			array(
				'tag__in' => $tag_ids,
				'numberposts'  => $i,
				'post__not_in' => array( $id )
			)
		);
	}

	return $related;
}

// [related-posts]
function related_posts() {

	global $post;

	$html = '<div class="related-posts related-post-thumbs clearfix">';
	$html .= '<div class="col-md-12"><h4>Recommended for you <small>beta</small></h4></div>';
	$html .= display_recommended_content( $post->post_content );
	$html .= '</div>';

	return $html;
}

add_shortcode( 'related-posts', 'related_posts' );

function cache_data() {

	$transient_cache = get_transient( 'cache-recommended' );

	if ( !$transient_cache ) {
		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'post'
		);

		$xml = '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0"><channel>';
		$post_query = new WP_Query($args);

		if ( $post_query->have_posts() ) {
			while($post_query->have_posts() ) {
				$post_query->the_post();

				$xml .= '<item>';

				$xml .= '<id>' . get_the_ID() . '</id>';
				$xml .= '<title>' . get_the_title() . '</title>';
				$xml .= '<link>' . get_permalink() . '</link>';
				$terms = '';
				$tags = get_the_tags();
				if ( $tags ) {
					foreach($tags as $tag) {
						$terms .=  '<term>' . $tag->name . '</term>';
					}
				}
				$cats = get_the_category();
				if ( $cats ) {
					foreach($cats as $cat) {
						$terms .=  '<term>' . $cat->name . '</term>';
					}
				}

				$xml .= '<terms>' . $terms . '</terms>';

				$xml .= '</item>';
			}
		}

		$xml .= '</channel></rss>';

		set_transient( 'cache-recommended', $xml, DAY_IN_SECONDS );

	}

	return $transient_cache;
}
