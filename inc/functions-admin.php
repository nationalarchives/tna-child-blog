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
    register_setting( 'homepage-settings-group', 'blog_type' );
    register_setting( 'homepage-settings-group', 'blog_header_img' );
    register_setting( 'homepage-settings-group', 'blog_img_caption' );
    register_setting( 'homepage-settings-group', 'blog_img_url' );
    register_setting( 'homepage-settings-group', 'blog_all_posts_url' );
    register_setting( 'homepage-settings-group', 'blog_comments' );
    register_setting( 'homepage-settings-group', 'blog_comments_message' );

    for ( $i=1 ; $i<=4 ; $i++ ) {

        register_setting( 'homepage-settings-group', 'series_title_'.$i );
        register_setting( 'homepage-settings-group', 'series_url_'.$i );
        register_setting( 'homepage-settings-group', 'series_image_'.$i );
        register_setting( 'homepage-settings-group', 'series_text_'.$i );
    }
}

function blog_admin_page() {
    if (!current_user_can('administrator'))  {
        wp_die( __('You do not have sufficient pilchards to access this page.')    );
    }
    ?>
    <div class="wrap tna-homepage">
        <h1>Blog settings</h1>
        <style>
            .blog-admin input[type=text], .blog-admin textarea {
                width: 100%;
                max-width: 300px;
            }
        </style>
        <form method="post" action="options.php" novalidate="novalidate" class="blog-admin">
            <?php settings_fields( 'homepage-settings-group' ); ?>
            <?php do_settings_sections( 'homepage-settings-group' ); ?>
            <h2>General</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="blog_type">Blog type</label></th>
                    <td>
                        <select name="blog_type">
                            <option <?php if (get_option('blog_type') == 'blog') { echo ' selected="selected"'; }; ?> value="blog">Standard blog</option>
                            <option <?php if (get_option('blog_type') == 'amp') { echo ' selected="selected"'; }; ?> value="amp">Archives Media Player</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="blog_comments">Comments</label></th>
                    <td>
                        <select name="blog_comments">
                            <option <?php if (get_option('blog_comments') == 'enabled') { echo ' selected="selected"'; }; ?> value="enabled">Comments enabled</option>
                            <option <?php if (get_option('blog_comments') == 'disabled') { echo ' selected="selected"'; }; ?> value="disabled">Comments disabled</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="blog_comments_message">Comments message (when disabled)</label></th>
                    <td><textarea name="blog_comments_message"><?php echo esc_attr( get_option('blog_comments_message') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
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

            <?php for ( $i=1 ; $i<=4 ; $i++ ) { ?>
                <h2>Mini series <?php echo $i; ?> (AMP only)</h2>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="series_title_<?php echo $i; ?>">Title</label></th>
                        <td><input type="text" name="series_title_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('series_title_'.$i) ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="series_url_<?php echo $i; ?>">URL</label></th>
                        <td><input type="text" name="series_url_<?php echo $i; ?>" value="<?php echo get_option('series_url_'.$i); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="series_image_<?php echo $i; ?>">Image URL</label></th>
                        <td><input type="text" name="series_image_<?php echo $i; ?>" value="<?php echo get_option('series_image_'.$i); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="series_text_<?php echo $i; ?>">Description</label></th>
                        <td><textarea name="series_text_<?php echo $i; ?>"><?php echo esc_attr( get_option('series_text_'.$i) ); ?></textarea></td>
                    </tr>
                </table>
            <?php } ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
