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
					<div class="entry-content">
						<div class="col-md-2">

						</div>
						<div class="col-md-6">
							<form action="<?php bloginfo('url'); ?>" method="get">
								<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
									<option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option>
									<?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
								</select>
								<?php wp_dropdown_users(array('name' => 'author','show_option_none' => 'Select author...')); ?>
								<input class="sr-only" type="submit" name="submit" />
							</form>
						</div>
						<div class="col-md-4">
							<div class="search-wrapper">
								<form id="search-form" method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<label class="sr-only" for="s">Search</label>
									<input type="text" name="s" id="s" class="search-field" placeholder="Search our Blog" />
									<input type="submit" id="searchsubmit" class="search-button search-button-blog" alt="Submit search" value="" title="Submit" />
								</form>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>