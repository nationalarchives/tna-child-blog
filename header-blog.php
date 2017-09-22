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
						<div class="col-md-2">
							<div class="follow-us">
								<a href="http://www.nationalarchives.gov.uk/rss/" title="Follow us via RSS">
									<img src="https://nationalarchives.gov.uk/wp-content/themes/tna-base/img/social/rss.png" alt="RSS logo"></a>
								Subscribe
							</div>
						</div>
						<div class="col-md-6">
							<form action="<?php bloginfo('url'); ?>" method="get" class="author-list">
								<label class="sr-only" for="author">Select an author</label>
								<?php wp_dropdown_users(array('name' => 'author','show_option_none' => 'Select an author...')); ?>
								<noscript>
									<input type="submit" name="submit" value="view" />
								</noscript>
							</form>
							<script type="text/javascript">
								<!--
								var dropdown = document.getElementById("author");
								function onAuChange() {
									if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
										location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?author="+dropdown.options[dropdown.selectedIndex].value;
									}
								}
								dropdown.onchange = onAuChange;
								-->
							</script>
						</div>
						<div class="col-md-4">
							<div class="search-wrapper">
								<div class="search-wrapper">
									<?php get_search_form(); ?>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>
