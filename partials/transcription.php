<?php if ( get_option('blog_type') == 'amp' && function_exists('get_field') ) { ?>
	<?php if (get_field('transcription')) { ?>
	<div id="transcription" class="entry-content entry-media-transcription clearfix">
		<h2>Transcription</h2>
		<div class="transcription-content">
			<?php the_field('transcription'); ?>
		</div>
	</div>
	<?php } ?>
<?php } ?>
