<div class="blog-toolbar">
    <div class="row">
    <?php if ( is_amp() ) {
        $video_id = get_cat_ID( 'video' );
        $audio_id = get_cat_ID( 'audio' );
        ?>
        <div class="hidden-xs col-sm-4 col-md-3 toolbar-col">
            <div class="media-buttons">
                <a href="<?php echo get_category_link( $video_id ) ; ?>" class="button">
                    Video
                </a> <a href="<?php echo get_category_link( $audio_id ) ; ?>" class="button">
                    Audio
                </a>
            </div>
        </div>
    <?php } else {?>
        <div class="col-xs-12 col-sm-4 col-md-3 toolbar-col">
            <form action="" method="get" id="category-list">
                <label class="sr-only" for="month">Select a category</label>
                <?php wp_dropdown_categories( array('show_option_none' => __( 'Select a category' ),'orderby' => 'name','exclude' => '1')); ?>
                <noscript>
                    <input type="submit" name="submit" value="view" />
                </noscript>
            </form>
        </div>
    <?php } ?>
        <div class="col-xs-12 col-sm-4 col-md-3 toolbar-col">
            <form action="" method="get" class="month-list">
                <label class="sr-only" for="month">Select month</label>
                <select name="month" id="month">
                    <option value="">Select a month</option>
                    <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
                </select>
                <noscript>
                    <input type="submit" name="submit" value="view" />
                </noscript>
            </form>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 toolbar-col">
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
        <div class="col-xs-12 col-sm-12 col-md-3 toolbar-search">
            <div class="search-wrapper">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>