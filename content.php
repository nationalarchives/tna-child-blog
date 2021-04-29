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
		<?php get_template_part( 'partials/player' ); ?>
		<div class="entry-header">
			<h1 class="separator-heading"><?php the_title(); ?></h1>
		</div>
		<div class="entry-meta">
			<p><?php the_entry_meta(); ?></p>
			<?php get_template_part( 'partials/credits' ); ?>
		</div>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div>
		<?php get_template_part( 'partials/gallery' ); ?>
		<?php get_template_part( 'partials/slides' ); ?>
		<?php get_template_part( 'partials/transcription' ); ?>
		<?php $tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) { ?>
		<div class="tags">
			<h3 class="inline">Tags</h3>
			<p><?php echo $tags_list; ?></p>
		</div>
		<?php } ?>
		<?php comments_template(); ?>
	</article>
<?php } ?>
