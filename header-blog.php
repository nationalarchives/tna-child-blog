<?php
/**
 * Blog header
 */
?>

<div class="blog-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12" role="banner">
				<article>
					<div class="entry-header" style="background-image: url(<?php echo esc_attr( get_option('blog_header_img') ); ?>);">
						<h1>Blog</h1>
						<?php get_image_caption( 'top' ) ?>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>