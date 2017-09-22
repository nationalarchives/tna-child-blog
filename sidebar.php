<?php
/**
 * Sidebar
 *
 */

if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
	<aside id="sidebar" class="col-xs-12 col-sm-4" role="complementary">
		<?php dynamic_sidebar( 'blog-sidebar' ); ?>
	</aside>
<?php endif; ?>
