<?php if (get_field('slideshare')) { ?>
<div id="slides" class="entry-content entry-media-slideshare">
	<h2>Slides</h2>
	<div class="slides">
	<?php the_field ('slideshare'); ?>
	</div>
</div>
<?php } ?>