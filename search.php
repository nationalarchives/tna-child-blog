<?php get_header(); ?>
<?php get_template_part('breadcrumb'); ?>
<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area search-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-xs-12 col-sm-8 col-md-8" role="main">
                <article>
                    <div class="entry-header">
                        <h1><?php _e( 'Search results found for', 'tna-base' ); ?>: <?php the_search_query(); ?></h1>
                    </div>
                    <div class="entry-content clearfix">
                    <?php if ( have_posts() ) { ?>

                        <ul class="search-results">
                        <?php while ( have_posts() ) { the_post(); ?>
                            <li>
                                <h3>
                                    <a href="<?php echo get_permalink(); ?>">
                                        <?php the_title();  ?>
                                    </a>
                                </h3>
                                <div class="entry-meta">
                                    <p>
                                        <?php the_time('l j F Y ') ?>
                                        |
                                        <?php the_author_posts_link(); ?>
                                        |
                                        <?php if (get_the_category_list()) {
                                            echo get_the_category_list( ', ' ).' |';
                                        } ?>
                                        <?php comments_popup_link( 'Comment', '1 comment', '% comments' ); ?>
                                    </p>
                                </div>
                                <p>
                                    <?php echo trim(substr(get_the_excerpt(), 0,160)).'...'; ?>
                                    <a href="<?php the_permalink(); ?>">Read more</a>
                                </p>
                            </li>
                        <?php } ?>
                        </ul>

                        <?php
                        global $wp_query;
                        $big = 999999999;
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages
                        ) );
                        ?>

                    <?php } else {
                        _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'tna-base' );
                        get_search_form();
                    }?>
                    </div>
                </article>
            </main>
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>


