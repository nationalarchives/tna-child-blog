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
 * @param $date_mod
 * @param $excerpt
 * @param $authors
 *
 * @return string
 */
function blog_schema_json( $title, $image, $keywords, $words, $url, $date, $date_mod, $excerpt, $authors ) {

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
	"dateModified": "%s",
	"mainEntityOfPage": {
         "@type": "WebPage",
         "@id": "http://www.nationalarchives.gov.uk/"
      },
	"description": "%s",
	"publisher": {
	     "@type": "Organization",
	     "name": "The National Archives",
	     "logo": {
            "@type": "ImageObject",
            "url": "https://cdn.nationalarchives.gov.uk/logos/tna-logo-col-330x50.png"
        }
	},
	"author": {
		"@type": "Person",
		"name": "%s"
	}
}
</script>
';

	return sprintf( $json, $title, $image, $keywords, $words, $url, $date, $date_mod, $excerpt, $authors );
}

function tna_blog_schema() {
	$title = get_the_title();
	$image = get_feature_image_url( get_the_ID(), 'full', false );
	$keywords = strip_tags(get_the_tag_list( '', ', ' ));
	$words = str_word_count(get_the_content());
	$url = get_permalink();
	$date = get_the_date( 'Y-m-d' );
	$date_mod = get_the_modified_date( 'Y-m-d' );
	$excerpt = get_the_excerpt();
	$author = get_the_author();
	echo blog_schema_json( $title, $image, $keywords, $words, $url, $date, $date_mod, $excerpt, $author );
}