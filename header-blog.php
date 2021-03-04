<?php
/**
 * Blog header
 */
?>

<div class="blog-header feature-img">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <?php get_template_part('blog-breadcrumb'); ?>
                <div class="entry-header" style="background-image: url(<?php echo esc_attr( https_this( get_option('blog_header_img') ) ); ?>);">
                    <h1 class="h1">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php if ( is_amp() ) {
                                echo 'Archives Media Player';
                            } else {
                                echo 'Blog';
                            } ?>
                        </a>
                    </h1>
                    <?php get_blog_image_caption(
                        esc_attr( get_option('blog_img_caption') ),
                        esc_url( get_option('blog_img_url') )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php get_template_part( 'partials/toolbar' ); ?>
            </div>
        </div>
    </div>
</div>

