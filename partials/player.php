<?php if ( get_option('blog_type') == 'amp' && function_exists('get_post_custom_values') ) { ?>
	<?php
	if ( in_category('video') || in_category('audio') ) {
	$media = get_post_custom_values('audioFile');
	?>
	<div class="entry-video clearfix">
		<div class="video-container">
			<div id="player">
				<p>To view this media, you will require <a href="http://www.adobe.com/products/flashplayer/" class="external-link">Adobe Flash 9</a> or higher and must have <strong>Javascript enabled</strong>.</p>
			</div>
			<script type='text/javascript'>
				jwplayer('player').setup({
					'flashplayer': '<?php echo get_stylesheet_directory_uri(); ?>/inc/player.swf',
					'file': '<?php echo media_file( $media ); ?>',
					'title': '<?php the_title(); ?>',
					'image':  '<?php global $post; echo get_feature_image_url( $post->ID, 'large' ); ?>',
					'width': '500',
					'height': '358'
				});
			</script>
		</div>
		<div class="video-toolbar clearfix">
			<div class="col-xs-6">
				<?php echo media_duration( get_post_custom_values('duration') ); ?>
			</div>
			<div class="col-xs-6 text-right">
				<?php if ( $media ) {
					if ( strpos($media[0], 'youtu') !== false ) { ?>
						<a href="<?php echo media_file( $media ); ?>">Watch video on YouTube</a>
					<?php } else { ?>
						<a href="<?php echo relative_path( media_file( $media ) ); ?>" title="Please save the file by right clicking and selecting 'Save Target As' or 'Save Link As' as option." download>Download media file</a>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
<?php } ?>
