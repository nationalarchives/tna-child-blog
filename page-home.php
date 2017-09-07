<?php
/*
 * Template Name: Blog home
 *
 */
get_header(); ?>

<?php get_template_part( 'breadcrumb' ); ?>

<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<main id="main" class="col-md-12" role="main">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content' );
				endwhile;
				?>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>
