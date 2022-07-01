<?php get_header(); ?>

<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area category-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-md-12" role="main">
                <article>
                    <div class="entry-header">
                        <h1>
                            <?php _e( '<span>Category: </span>', 'tna-base' ); ?><?php single_cat_title(); ?>
                        </h1>
                    </div>
<?php if (is_category('Podcasts') || is_category('Video')) { ?>
<div class="entry-content clearfix">
<?php echo category_description();?>
</div>
<?php } ?>

                    <div class="entry-content clearfix">
	                    <?php get_template_part('content', 'loop'); ?>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>

<?php get_footer(); ?>

