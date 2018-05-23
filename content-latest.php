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
			<?php get_template_part( 'content-item' ); ?>
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