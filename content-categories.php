<?php

$categories = get_categories(); ?>

<?php foreach ( $categories as $cat ) {

	if ( $cat->slug != 'uncategorized' ) {

		$active = ($cat->slug == 'records-research') ? 'active' : '';

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
			<h3 id="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></h3>
			<div class="cards">
				<div class="row">
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php get_template_part( 'content-item' ); ?>
					<?php endwhile; ?>
					<!-- end of the loop -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="<?php echo esc_url( get_category_link( $cat->cat_ID ) ); ?>" class="button pull-right">View all '<?php echo $cat->name; ?>' posts</a>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif;
	}
} ?>
