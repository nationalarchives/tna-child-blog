<?php if ( ! is_single() ) { ?>
	<!-- page.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div>
	</article>
<?php } else { ?>
	<!-- singe.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="entry-meta">
			<p>
			<?php the_time('l j F Y ') ?>
			|
			<?php get_blog_authors(); ?>
			|
			<?php echo get_the_category_list( ', ' ); ?>
			|
			<?php comments_popup_link( 'Comment', '1 comment', '% comments' ); ?>
			</p>
		</div>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div>
		 <?php
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) { ?>
		<div class="tags">
			<h3 class="inline">Tags</h3>
			<p>
				<?php echo $tags_list; ?>
			</p>
		</div>
		<div id="blogsocial">
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_facebook"></a><a class="addthis_button_twitter"></a><a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-500565897ff2ca83"></script>
		</div>
		<?php } ?>
		<?php comments_template(); ?>
	</article>
<?php } ?>