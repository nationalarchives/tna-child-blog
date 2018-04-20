<?php if (function_exists('get_field')) { ?>
	<?php if (get_field('transcription')) { ?>
	<div id="transcription" class="entry-content entry-media-transcription clearfix">
		<h2>Transcription</h2>
		<?php the_field ('transcription'); ?>
	</div>
	<?php } ?>
<?php } ?>
