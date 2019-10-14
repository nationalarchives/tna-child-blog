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
		if (isset($cat_object->slug)) {
            $slug = $cat_object->slug;
        } else {
            $slug = '';
        }
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
				<div role="tabpanel" class="row tab-pane cards <?php echo $active; ?>" id="<?php echo $cat->slug; ?>">

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php get_template_part( 'content-item' ); ?>

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
