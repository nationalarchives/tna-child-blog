<?php get_header(); ?>
<?php get_template_part('breadcrumb'); ?>
<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area category-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-md-12" role="main">
                <article>
                    <div class="entry-header">
                        <h2 class="separator-heading">
                            <?php _e( 'Category', 'tna-base' ); ?>: <?php single_cat_title(); ?>
                        </h2>
                    </div>
                    <div class="entry-content clearfix">
	                    <?php get_template_part('content', 'loop'); ?>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>

<?php get_footer(); ?>

