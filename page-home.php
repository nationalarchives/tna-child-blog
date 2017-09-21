<?php
/*
 * Template Name: Blog home
 *
 */
get_header(); ?>

<?php get_template_part( 'breadcrumb' ); ?>
<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<main id="main" role="main">
				<div class="col-md-12">
					<article>
						<div class="entry-header">
							<h2>Latest posts</h2>
						</div>
						<div class="entry-content clearfix">
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

								<!-- the loop -->
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

									<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
										<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
										<img src="<?php echo $image[0]; ?>">
									<?php endif; ?>
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
								<?php endwhile; ?>
								<!-- end of the loop -->

								<?php wp_reset_postdata(); ?>

							<?php else : ?>
								<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
							<?php endif; ?>

						</div>
					</article>
				</div>
				<div class="col-md-12">
					<article>
						<div class="entry-header">
							<h2>Posts by category</h2>
						</div>
						<div class="entry-content clearfix">

						</div>
					</article>
				</div>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>
