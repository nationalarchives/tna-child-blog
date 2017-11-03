<?php
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'orderby' => 'date',
	'order'   => 'DESC',
	'posts_per_page' => 3
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<div id="latest-posts" class="row">

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php $image = get_feature_image_url( get_the_ID() , 'feature-box-thumb', true ); ?>
		<div class="col-md-4">
			<a href="<?php echo get_permalink(); ?>">
				<div class="feature-img-bg" <?php echo $image; ?>></div>
			</a>
			<h3>
				<a href="<?php echo get_permalink(); ?>">
					<?php the_title();  ?>
				</a>
			</h3>
			<div class="entry-meta">
				<p>
					<?php the_time('l j F Y ') ?>
					<br>
					<?php get_blog_authors(); ?>
					|
					<?php comments_popup_link( 'Comment', '1 comment', '% comments' ); ?>
				</p>
			</div>
			<p>
				<?php echo trim(substr(get_the_excerpt(), 0,160)).'...'; ?>
				<a href="<?php the_permalink(); ?>">read more</a>
			</p>
		</div>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<?php wp_reset_postdata(); ?>

	<?php if ( get_option('blog_all_posts_url') ) { ?>
		<div class="col-md-12">
			<a href="<?php echo esc_attr( get_option('blog_all_posts_url') ); ?>" class="button pull-right">View all posts</a>
		</div>
	<?php } ?>

	</div>


<?php else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>