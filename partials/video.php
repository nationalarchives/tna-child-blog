<div class="entry-video clearfix">
	<div class="video-container">
		<div id="player">
			<p>To view this media, you will require <a href="http://www.adobe.com/products/flashplayer/" class="external-link">Adobe Flash 9</a> or higher and must have <strong>Javascript enabled</strong>.</p>
		</div>
		<script type='text/javascript'>
			jwplayer('player').setup({
				'flashplayer': '<?php echo get_stylesheet_directory_uri(); ?>/inc/player.swf',
				'file': '<?php echo get_stylesheet_directory_uri().'/tests/test.mp4'; ?>',
				'title': '<?php the_title(); ?>',
				'image':  '<?php if (has_post_thumbnail( $post->ID ) ): ?><?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'main-image' ); ?><?php echo $image[0]; ?><?php endif; ?>',
				'width': '500',
				'height': '358'
			});
		</script>
	</div>
	<div class="video-toolbar clearfix">
		<div class="col-xs-6">
			<span class="addthis_toolbox addthis_default_style addthis_20x20_style">
				<a class="addthis_button_facebook"></a><a class="addthis_button_twitter"></a><a class="addthis_button_compact"></a>
			</span>
		</div>
		<div class="col-xs-6 text-right">
			<a href="#">Download media file</a>
		</div>
	</div>
</div>
