<?php
/**
 * Blog header
 */
?>

<div class="blog-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<div class="entry-header">
						<h1 class="separator-heading">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php if ( is_amp() ) {
									echo 'Archives Media Player';
								} else {
									echo 'The National Archives\' blog';
								} ?>
							</a>
						</h1>
					</div>
					<div class="entry-content">
                        <div class="row">
                            <div class="hidden-xs col-sm-2 col-md-2">
                                <div class="follow-us">
                                    <a href="http://www.nationalarchives.gov.uk/rss/" title="Follow us via RSS">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/social/rss.png" alt="RSS logo"></a>
                                    Subscribe
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <div class="row">
                                    <?php if ( is_amp() ) {
                                        $video_id = get_cat_ID( 'video' );
                                        $audio_id = get_cat_ID( 'audio' );
                                        ?>
                                        <div class="hidden-xs hidden-sm col-md-6">
                                            <a href="<?php echo esc_url( get_category_link( $video_id ) ); ?>" class="button button-icon icon-video">
                                                Video
                                            </a>
                                            <a href="<?php echo esc_url( get_category_link( $audio_id ) ); ?>" class="button button-icon icon-audio">
                                                Audio
                                            </a>
                                        </div>
                                    <?php } else { ?>
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
                                    <?php } ?>
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
					</div>
			</div>
		</div>
	</div>
</div>
