<?php get_header(); ?>
<?php get_template_part('breadcrumb'); ?>

<div id="primary" class="content-area search-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-xs-12 col-sm-8 col-md-8" role="main">
                <article>
                    <div class="entry-header">
                        <h1><?php _e( 'Search Results Found For', 'locale' ); ?> <?php the_search_query(); ?></h1>
                    </div>
                    <div class="entry-content clearfix">

                    <?php if ( have_posts() ) { ?>

                        <ul>

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

                        <?php echo paginate_links(); ?>

                    <?php } ?>
                    </div>
                </article>
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-4" role="complementary">
                <div class="sidebar-header">
                    <h2>Search</h2>
                </div>
                <div class="sidebar-content clearfix">
                    <?php get_search_form(); ?>
                </div>
            </aside>
            </div>


    </div>
</div>
</div>

<?php get_footer(); ?>


