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
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="entry-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <form action="" method="get">
                                <label class="sr-only" for="category">Select a category</label>
                                <select name="category" id="category">
                                    <option value="">Select a category</option>
                                </select>
                                <noscript>
                                    <input type="submit" name="submit" value="view" />
                                </noscript>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <form action="" method="get">
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
                            <form action="<?php bloginfo('url'); ?>" method="get">
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
