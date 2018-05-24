<?php

$categories = get_categories(); ?>

<ul class="nav nav-pills" role="tablist">
	<li class="active">
		<a  href="#records-research" role="tab" data-toggle="pill">Records and research</a>
	</li>
	<li>
		<a href="#behind-the-scenes" role="tab" data-toggle="pill">Behind the scenes</a>
	</li>
	<li>
		<a href="#technology-innovation" role="tab" data-toggle="pill">Technology and innovation</a>
	</li>
	<li>
		<a href="#managing-information" role="tab" data-toggle="pill">Managing information</a>
	</li>
	<li>
		<a href="#archives-and-archivists" role="tab" data-toggle="pill">Archives and archivists</a>
	</li>
</ul>
<div class="tab-content clearfix">
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
				<div role="tabpanel" class="row tab-pane <?php echo $active; ?>" id="<?php echo $cat->slug; ?>">

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php get_template_part( 'content-item' ); ?>
					<?php endwhile; ?>
					<!-- end of the loop -->

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
</div>
