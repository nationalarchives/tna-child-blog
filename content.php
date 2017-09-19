<?php if ( ! is_single() ) { ?>
	<!-- page.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<h1><?php the_title(); ?></h1>
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
			<?php the_author_posts_link(); ?>
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
		<?php } ?>
		<?php comments_template(); ?>
	</article>
<?php } ?>