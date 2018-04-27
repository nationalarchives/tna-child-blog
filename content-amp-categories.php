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
<ul class="nav nav-pills" role="tablist">
	<?php foreach ( $selected_categories as $cat_name ) {
		$cat_object = get_term_by( 'name', $cat_name, 'category');
		$slug = $cat_object->slug;
		$active = ($slug == 'family-history') ? ' class="active"' : '';
		?>
		<li<?php echo $active ?>>
			<a  href="#<?php echo $slug ?>" role="tab" data-toggle="pill"><?php echo $cat_name ?></a>
		</li>
	<?php } ?>
</ul>
<div class="tab-content clearfix">
	<?php

	foreach ( $selected_categories as $cat_name ) {

		$cat = get_term_by( 'name', $cat_name, 'category');

		if ( $cat ) {

			$active = ($cat->slug == 'family-history') ? 'active' : '';

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
						<?php
						$image = get_feature_image_url( get_the_ID(), 'feature-box-thumb', true );
						if ( AMP && in_category('video')) {
							$icon = '<div class="icon-circle icon-video"></div>';
						} elseif ( AMP && in_category('audio')) {
							$icon = '<div class="icon-circle icon-audio"></div>';
						} else {
							$icon = '';
						}
						?>
						<div class="latest-post col-md-4">
							<a href="<?php echo get_permalink(); ?>" class="feature-img" title="<?php the_title(); ?>">
								<div class="feature-img-bg" <?php echo $image; ?>>
									<?php echo $icon; ?>
								</div>
							</a>
							<?php
							if ( AMP && in_category('video')) {
								echo '<div class="content-type">Video</div>';
							} elseif ( AMP && in_category('audio')) {
								echo '<div class="content-type">Audio</div>';
							}
							?>
							<h3>
								<a href="<?php echo get_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<div class="entry-meta">
								<p>
									<?php the_entry_meta( array(
										'cat'       => false,
										'home'      => true
									) ); ?>
								</p>
							</div>
							<p>
								<?php echo trim( substr( get_the_excerpt(), 0, 160 ) ) . '...'; ?>
								<a href="<?php the_permalink(); ?>">read more</a>
							</p>
						</div>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<div class="col-md-12">
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="button pull-right">View all '<?php echo $cat->name; ?>' posts</a>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<div role="tabpanel" class="row tab-pane <?php echo $active; ?>" id="<?php echo $cat->slug; ?>">
					<div class="col-md-12">
						<p><?php esc_html_e( 'Sorry, no posts matched the category.' ); ?></p>
					</div>
				</div>
			<?php endif;
		}
	} ?>
</div>
