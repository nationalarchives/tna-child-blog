<?php
/**
 * Blog header
 */
?>

<div class="blog-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12" role="banner">
				<article class="banner feature-img feature-img-bg" style="background-image: url(<?php echo esc_attr( get_option('blog_header_img') ); ?>);">
					<div class="entry-header">
						<h1>Blog</h1>
					</div>
					<?php get_blog_image_caption(
						get_option('blog_img_caption'),
						get_option('blog_img_url')
					); ?>
				</article>
			</div>
		</div>
	</div>
</div>