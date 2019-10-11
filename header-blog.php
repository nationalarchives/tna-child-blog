<?php
/**
 * Blog header
 */
?>

<div class="blog-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <?php get_template_part('breadcrumb'); ?>
                <div class="entry-header">
                    <div class="h1">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php if ( is_amp() ) {
                                echo 'Archives Media Player';
                            } else {
                                echo 'Blog';
                            } ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-toolbar">
                    <div class="entry-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <?php if ( is_amp() ) {
                                $video_id = get_cat_ID( 'video' );
                                $audio_id = get_cat_ID( 'audio' );
                                ?>
                                <div class="media-buttons">
                                    <a href="<?php echo get_category_link( $video_id ) ; ?>" class="button">
                                        Video
                                    </a> <a href="<?php echo get_category_link( $audio_id ) ; ?>" class="button">
                                        Audio
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <form action="" method="get" class="month-list">
                                    <label class="sr-only" for="month">Select month</label>
                                    <select name="month" id="month">
                                        <option value="">Select month</option>
                                        <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
                                    </select>
                                    <noscript>
                                        <input type="submit" name="submit" value="view" />
                                    </noscript>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <form action="<?php bloginfo('url'); ?>" method="get" class="author-list">
                                    <label class="sr-only" for="author">Select an author</label>
                                    <select name="author" id="author">
                                        <option value="-1">Select an author</option>
                                        <?php get_blog_list_authors(); ?>
                                    </select>
                                    <noscript>
                                        <input type="submit" name="submit" value="view" />
                                    </noscript>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
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
</div>

