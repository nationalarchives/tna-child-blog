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
			$data['img'][0]         = 'https://via.placeholder.com/480x200';
			$data['url']            = $url;
			$i                      = 0;
			foreach ( $html->getElementsByTagName( 'meta' ) as $meta ) {
				if ( $meta->getAttribute( 'property' ) == 'og:title' ) {
					$data['title'] = $meta->getAttribute( 'content' );
				}
				if ( $meta->getAttribute( 'property' ) == 'og:description' ) {
					$data['description'] = $meta->getAttribute( 'content' );
				}
				if ( $meta->getAttribute( 'property' ) == 'og:image' ) {
					$data['img'][ $i ] = $meta->getAttribute( 'content' );
					$i ++;
				}
			}
			return $data;
		}
	}
	return false;
}



function display_relative_content( $content, $categories='', $tags='' ) {

	//return array
	$ret = '';
	$content_links = array();

	/*** a new dom object ***/
	$dom = new domDocument;

	/*** get the HTML (suppress errors) ***/
	@$dom->loadHTML($content);

	/*** remove silly white space ***/
	$dom->preserveWhiteSpace = false;

	/*** get the links from the HTML ***/
	$links = $dom->getElementsByTagName('a');

	/*** loop over the links ***/
	foreach ($links as $link_obj)
	{
		$link = $link_obj->getAttribute('href');
		$ret .= $link . ' <br>';
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

	$recommended = '';
	global $post;
	$transient_recommended = get_transient( 'recommended-'.$post->ID );

	if ( !$transient_recommended ) {
		foreach ( $content_links as $url ) {

			$data = blog_get_meta_og_data( $url );

			$html = '<div class="col-md-4 recommended-'.$post->ID.'"><a href="%s"><img src="%s" class="img-responsive"><h4>%s</h4><p>%s</p></a></div>';

			$recommended .= sprintf($html, $data['url'], $data['img'][0], $data['title'], $data['description'] );
		}

		set_transient( 'recommended-'.$post->ID, $recommended, DAY_IN_SECONDS );

		return $recommended;
	}

	return $transient_recommended . '<!-- transient_recommended -->' ;
}