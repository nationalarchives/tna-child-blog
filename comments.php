<?php
/**
 * The template for displaying comments
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if (1 === $comments_number) {
                /* translators: %s: post title */
                printf(_x('One thought on &ldquo;%s&rdquo;', 'comments title'), get_the_title());
            } else {
                printf(
                /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s comments',
                        '%1$s comments',
                        $comments_number,
                        'comments title'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h3>

        <div class="comments-navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>

        <ol class="commentlist">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'avatar_size' => 42,
            ));
            ?>
        </ol><!-- .comment-list -->

        <div class="comments-navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>

    <?php endif; // Check for have_comments(). ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open()
        // && get_comments_number()
        // && post_type_supports(get_post_type(), 'comments')
    ) :
        ?>
        <div class="comments-closed clearfix">
            <div class="emphasis-alert">
                <h2 class="no-comments"><?php _e('Comments are temporarily closed'); ?></h2>
                <p><?php echo get_option('blog_comments_message'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h2><div class="disclaimer clearfix"><div class="emphasis-alert"><a href="https://www.nationalarchives.gov.uk/contact-us/make-a-records-and-research-enquiry/">Visit this page for family history and other research enquiries</a>. Please do not post personal information. All comments are pre-moderated. See our <a href="https://blog.nationalarchives.gov.uk/moderation-policy/">moderation policy</a> for more details.</div></div>',
        'comment_notes_after' => '',
        'title_reply'       => __( 'Leave a comment' ),
    ));
    ?>

</div><!-- .comments-area -->
