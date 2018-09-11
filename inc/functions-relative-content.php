<?php



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
	
	var_dump( $content_links );

}