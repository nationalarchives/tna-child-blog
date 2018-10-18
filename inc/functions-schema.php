<?php
/**
 * Schema.org
 *
 * @param $title
 * @param $image
 * @param $keywords
 * @param $words
 * @param $url
 * @param $date
 * @param $excerpt
 * @param $authors
 *
 * @return string
 */
function blog_schema_json( $title, $image, $keywords, $words, $url, $date, $excerpt, $authors ) {

	$json = '
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "BlogPosting",
	"headline": "%s",
	"image": "%s",
	"keywords": "%s",
	"wordcount": "%s",
	"url": "%s",
	"datePublished": "%s",
	"description": "%s",
	"publisher": {
	     "@type": "Organization",
	     "name": "The National Archives"
	}
	"author": {
		"@type": "Person",
		"name": "%s"
	}
}
</script>
';

	return sprintf( $json, $title, $image, $keywords, $words, $url, $date, $excerpt, $authors );
}

function tna_blog_schema() {
	$title = get_the_title();
	$image = get_feature_image_url( get_the_ID(), 'full', false );
	$keywords = strip_tags(get_the_tag_list( '', ' ' ));
	$words = str_word_count(get_the_content());
	$url = get_permalink();
	$date = get_the_date();
	$excerpt = get_the_excerpt();
	$author = get_the_author();
	echo blog_schema_json( $title, $image, $keywords, $words, $url, $date, $excerpt, $author );
}