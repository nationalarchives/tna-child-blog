<?php
/*
 * Template Name: AMP home
 *
 */
get_header(); ?>

<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<main id="main" role="main">
				<div class="col-md-12">
					<article>
						<div class="entry-header">
							<h1>Latest posts</h1>
						</div>
						<div class="entry-content clearfix">
							<?php get_template_part('content', 'latest'); ?>
						</div>
					</article>
				</div>
				<div class="col-md-12">
					<article>
						<div class="entry-content clearfix">
							<?php get_template_part('content', 'amp-categories'); ?>
						</div>
					</article>
				</div>
				<?php get_template_part('content', 'series'); ?>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>
