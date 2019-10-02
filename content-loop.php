<?php if ( have_posts() ) { ?>

	<div class="loop-results">
        <div class="cards">
            <div class="row">
            <?php while ( have_posts() ) {
                the_post();
                $image = get_feature_image_url( get_the_ID(), 'medium', true );
                $title   = get_the_title();
                $url     = get_permalink();
                $excerpt = trim(substr(get_the_excerpt(), 0,160)).'...';
                $label   = 'Blog';
                $date    = '';
                $id      = get_the_ID();

                echo display_card( $id, $url, $title, $excerpt, $image, $date, $label );
            } ?>
            </div>
        </div>
	</div>

	<?php
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
        'type' => 'list',
        'prev_text' => __('«'),
        'next_text' => __('»')
	) );

} else {

	if (is_search()) {
		_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'tna-base' );
		get_search_form();
	} else {
		_e( 'Sorry, it appears we don\'t have any published posts.', 'tna-base' );
	}
}