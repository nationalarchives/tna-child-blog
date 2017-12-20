<?php get_header(); ?>
<?php get_template_part('breadcrumb'); ?>
<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area search-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-xs-12 col-sm-8 col-md-8" role="main">
                <article>
                    <div class="entry-header">
                        <h2>
                            <?php _e( 'Search results found for', 'tna-base' ); ?>: <?php the_search_query(); ?>
                        </h2>
                    </div>
                    <div class="entry-content clearfix">
                        <?php get_template_part('content', 'loop'); ?>
                    </div>
                </article>
            </main>
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>


