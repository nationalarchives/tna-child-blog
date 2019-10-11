<?php
/**
 * Blog header
 */
?>

<div class="blog-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <?php get_template_part('breadcrumb'); ?>
                <div class="entry-header">
                    <div class="h1">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php if ( is_amp() ) {
                                echo 'Archives Media Player';
                            } else {
                                echo 'Blog';
                            } ?>
                        </a>
                    </div>
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

