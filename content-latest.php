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
			<?php
			$image = get_feature_image_url( get_the_ID() , 'feature-box-thumb', true );
			if (in_category('video')) {
				$icon = '<div class="icon-circle icon-video"></div>';
			} elseif (in_category('audio')) {
				$icon = '<div class="icon-circle icon-audio"></div>';
			} else {
				$icon = '';
			}
			?>
			<div class="col-md-4">
				<a href="<?php echo get_permalink(); ?>" class="feature-img" title="<?php the_title(); ?>">
					<div class="feature-img-bg" <?php echo $image; ?>>
						<?php echo $icon; ?>
					</div>
				</a>
				<?php
				if (in_category('video')) {
					echo '<div class="content-type">Video</div>';
				} elseif (in_category('audio')) {
					echo '<div class="content-type">Audio</div>';
				}
				?>
				<h3>
					<a href="<?php echo get_permalink(); ?>">
						<?php the_title();  ?>
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