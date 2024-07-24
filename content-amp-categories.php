<?php

$selected_categories = array(
	'Family history',
	'Military history',
	'Social history',
	'Political history',
	'Law and order',
	'Archives and archivists',
	'International'
);

?>
<div class="tab-content clearfix">
	<?php

	foreach ( $selected_categories as $cat_name ) {

		$cat = get_term_by( 'name', $cat_name, 'category');

		if ( $cat ) {

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



				<h2 id="<?php echo $cat->slug; ?>" class="separator-heading">Posts in '<?php echo $cat->name; ?>'</h2>
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
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="button pull-right">View all '<?php echo $cat->name; ?>' posts</a>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>

			<?php endif;
		}
	} ?>
</div>
