<?php if ( have_posts() ) { ?>

	<ul class="loop-results">
		<?php while ( have_posts() ) { the_post(); ?>
			<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h3>
					<a href="<?php echo get_permalink(); ?>">
						<?php the_title();  ?>
					</a>
				</h3>
				<div class="entry-meta">
					<p>
						<?php the_time('l j F Y ') ?>
						|
						<?php the_author_posts_link(); ?>
						|
						<?php if (get_the_category_list()) {
							echo get_the_category_list( ', ' ).' |';
						} ?>
						<?php comments_popup_link( 'Comment', '1 comment', '% comments' ); ?>
					</p>
				</div>
				<p>
					<?php echo trim(substr(get_the_excerpt(), 0,160)).'...'; ?>
					<a href="<?php the_permalink(); ?>">Read more</a>
				</p>
			</li>
		<?php } ?>
	</ul>

	<?php
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	) );

} else {

	if (is_search()) {
		_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'tna-base' );
		get_search_form();
	} else {
		_e( 'Sorry, it appears we don\'t have any published posts.', 'tna-base' );
	}
}