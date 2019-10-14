<?php get_header(); ?>
<?php get_template_part( 'header-blog' ); ?>

<div id="primary" class="content-area author-page">
    <div class="container">
        <div class="row">
            <main id="main" class="col-xs-12" role="main">
                <article>
                    <div class="entry-header">
                        <h1>
                            <?php
                            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                            _e( '<span>Posts by </span>', 'tna-base' ); ?><?php echo $curauth->display_name;
                            ?>
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

