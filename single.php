<?php get_header(); ?>
<?php get_template_part( 'breadcrumb' ); ?>
<?php get_template_part( 'header-blog' ); ?>

	<div id="primary" class="blog content-area">
		<div class="container">
			<div class="row">
				<main id="main" class="col-xs-12 col-sm-8 col-md-8" role="main">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'content' );
					endwhile;
					?>
				</main>
				<?php get_sidebar() ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>