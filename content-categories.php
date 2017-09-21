<?php

$categories = get_categories();

foreach ( $categories as $cat ) {

	if ( $cat->slug != 'uncategorized' ) {

		$args = array(
			'category_name'  => $cat->slug,
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => 3
		);
		// the query
		$the_query = new WP_Query( $args ); ?>

		<?php if ( $the_query->have_posts() ) : ?>
			<div id="<?php echo $cat->slug; ?>" class="row">

				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php $image = get_feature_image_url( get_the_ID(), 'single-post-thumbnail', true ); ?>
					<div class="latest-post col-md-4">
						<a href="<?php echo get_permalink(); ?>">
							<div class="feature-img-bg" <?php echo $image; ?>></div>
						</a>
						<h3>
							<a href="<?php echo get_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<div class="entry-meta">
							<p>
								<?php the_time( 'l j F Y ' ) ?>
								<br>
								<?php the_author_posts_link(); ?>
								|
								<?php comments_popup_link( 'Comment', '1 comment', '% comments' ); ?>
							</p>
						</div>
						<p>
							<?php echo trim( substr( get_the_excerpt(), 0, 160 ) ) . '...'; ?>
							<a href="<?php the_permalink(); ?>">Read more</a>
						</p>
					</div>
				<?php endwhile; ?>
				<!-- end of the loop -->

			</div>
			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif;
	}
} ?>