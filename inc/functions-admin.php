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
}

function blog_admin_page() {
	if (!current_user_can('administrator'))  {
		wp_die( __('You do not have sufficient pilchards to access this page.')    );
	}
	?>
	<div class="wrap tna-homepage">
	<h1>TNA homepage settings</h1>
	<form method="post" action="options.php" novalidate="novalidate">
		<?php settings_fields( 'homepage-settings-group' ); ?>
		<?php do_settings_sections( 'homepage-settings-group' ); ?>
		<h2>Blog settings</h2>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="blog_header_img">Header image</label></th>
				<td><input type="text" name="blog_header_img" value="<?php echo esc_attr( get_option('blog_header_img') ); ?>" /></td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
	</div>
	<?php
}
