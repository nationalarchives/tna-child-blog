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
						<h1>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								Blog
							</a>
						</h1>
					</div>
					<?php get_blog_image_caption(
						esc_attr( get_option('blog_img_caption') ),
						esc_url( get_option('blog_img_url') )
					); ?>
					<div class="entry-content">
						<div class="hidden-xs col-sm-2 col-md-2">
							<div class="follow-us">
								<a href="http://www.nationalarchives.gov.uk/rss/" title="Follow us via RSS">
									<img src="https://nationalarchives.gov.uk/wp-content/themes/tna-base/img/social/rss.png" alt="RSS logo"></a>
								Subscribe
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-6">
							<div class="row">
								<form action="" method="get" class="month-list col-xs-6 col-sm-12 col-md-6">
									<label class="sr-only" for="month">Select month</label>
									<select name="month" id="month">
										<option value="">Select month</option>
										<?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
									</select>
									<noscript>
										<input type="submit" name="submit" value="view" />
									</noscript>
								</form>
								<form action="<?php bloginfo('url'); ?>" method="get" class="author-list col-xs-6 col-sm-12 col-md-6">
									<label class="sr-only" for="author">Select an author</label>
									<select name="author" id="author">
										<option value="-1">Select an author...</option>
										<?php get_blog_list_authors(); ?>
									</select>
									<noscript>
										<input type="submit" name="submit" value="view" />
									</noscript>
								</form>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<div class="search-wrapper">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>
