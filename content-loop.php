<?php if ( have_posts() ) { ?>

	<div class="loop-results">
        <div class="cards">
            <div class="row">
            <?php while ( have_posts() ) {
                the_post();

                get_template_part( 'content-item' );

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
		_e( '<p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>', 'tna-base' );
		get_search_form();
	} else {
		_e( '<p>Sorry, it appears we don\'t have any published posts.</p>', 'tna-base' );
	}
}