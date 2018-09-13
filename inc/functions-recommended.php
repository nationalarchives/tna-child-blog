<?php

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



function display_recommended_content( $content ) {

	global $post;
	$recommended = '';
	// delete_transient( 'recommended-'.$post->ID );
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

		$html = '<div class="col-md-4 recommended-'.$post->ID.'"><a href="%s"><img src="%s" class="img-responsive"><h4>%s</h4></a><p><small>%s</small></p></div>';

		foreach ( $content_links as $url ) {

			$data = blog_get_meta_og_data( $url );

			$recommended .= sprintf($html, $data['url'], $data['img'][0], $data['title'], $data['type'] );
		}

		$count = count($content_links);

		if ( $count < 3 ) {
			$n = 3 - $count;
			// var_dump( get_related_posts( $n ) );
			$related = get_related_posts( $n );
			$relative = array();

			if ( $related ) {
				foreach( $related as $item ) {
					$relative['title']          = $item->post_title;
					$relative['img'][0]         = get_stylesheet_directory_uri().'/img/card-thumb.jpg';
					$relative['url']            = $item->guid;
					$relative['type']           = 'National Archives Blog';

					$recommended .= sprintf($html, $relative['url'], $relative['img'][0], $relative['title'], $relative['type'] );
				}
			}
		}

		set_transient( 'recommended-'.$post->ID, $recommended, DAY_IN_SECONDS );

		return $recommended;
	}

	return '<!-- transient_recommended -->' . $transient_recommended . '<!-- transient_recommended -->' ;
}

function get_related_posts( $i = 1 ) {
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
		$related_cats = array();
		$related_tags = array();

		foreach ($blog_list as $blog) {
			switch_to_blog(get_object_vars($blog)['blog_id']);
			/*$related_cats = get_posts(
				array(
					'category__in' => wp_get_post_categories($id),
					'numberposts'  => $i,
					'post__not_in' => array( $id )
				)
			);*/
			$related_tags = get_posts(
				array(
					'tag__in' => $tag_ids,
					'numberposts'  => $i,
					'post__not_in' => array( $id )
				)
			);
			restore_current_blog();
		}

		$related = array_merge( $related_tags, $related_cats );


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
