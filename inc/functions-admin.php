<?php
/**
 * Blog admin
 *
 */

function tna_blog_menu() {
	add_menu_page( 'Blog settings', 'Blog', 'administrator', 'blog-admin-page', 'blog_admin_page', 'dashicons-admin-generic', 21  );
	add_action( 'admin_init', 'blog_admin_page_settings' );
}

function blog_admin_page_settings() {
	register_setting( 'homepage-settings-group', 'blog_header_img' );
	register_setting( 'homepage-settings-group', 'blog_img_caption' );
	register_setting( 'homepage-settings-group', 'blog_img_url' );
	register_setting( 'homepage-settings-group', 'blog_all_posts_url' );
}

function blog_admin_page() {
	if (!current_user_can('administrator'))  {
		wp_die( __('You do not have sufficient pilchards to access this page.')    );
	}
	?>
	<div class="wrap tna-homepage">
	<h1>Blog settings</h1>
	<form method="post" action="options.php" novalidate="novalidate">
		<?php settings_fields( 'homepage-settings-group' ); ?>
		<?php do_settings_sections( 'homepage-settings-group' ); ?>
		<h2>Blog header</h2>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="blog_header_img">Header image</label></th>
				<td><input type="text" name="blog_header_img" value="<?php echo esc_attr( get_option('blog_header_img') ); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blog_img_caption">Image caption</label></th>
				<td><input type="text" name="blog_img_caption" value="<?php echo esc_attr( get_option('blog_img_caption') ); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="blog_img_url">Library image URL</label></th>
				<td><input type="text" name="blog_img_url" value="<?php echo esc_attr( get_option('blog_img_url') ); ?>" /></td>
			</tr>
		</table>
		<?php submit_button(); ?>
		<h2>All posts</h2>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="blog_all_posts_url">All posts URL</label></th>
				<td><input type="text" name="blog_all_posts_url" value="<?php echo esc_attr( get_option('blog_all_posts_url') ); ?>" /></td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
	</div>
	<?php
}
