<?php get_header(); ?>

<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area search-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-md-12" role="main">
                <article>
                    <div class="entry-header">
                        <h1>
                            <?php _e( '<span>Search results found for: </span>', 'tna-base' ); ?><?php the_search_query(); ?>
                        </h1>
                    </div>
                    <div class="entry-content clearfix">
                        <?php get_template_part('content', 'loop'); ?>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>


