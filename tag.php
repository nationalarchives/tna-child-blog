<?php get_header(); ?>

<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area tag-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-xs-12" role="main">
                <article>
                    <div class="entry-header">
                        <h1>
                            <?php _e( '<span>Tag: </span>', 'tna-base' ); ?><?php echo ucfirst(single_tag_title( '', false )); ?>
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

<?php get_footer(); ?>

