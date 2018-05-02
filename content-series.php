<?php if ( get_option('series_title_1') ) { ?>
<div class="col-md-12">
	<article>
		<div class="entry-header">
			<h2>Mini series</h2>
		</div>
		<div class="entry-content clearfix">
			<?php
			for ( $i=1 ; $i<=4 ; $i++ ) {
				$title =  esc_attr( get_option('series_title_'.$i) );
				$url =  get_option('series_url_'.$i);
				$image =  get_option('series_image_'.$i);
				$text =  esc_attr( get_option('series_text_'.$i) );
				?>
				<div class="latest-post col-md-3">
					<a href="<?php echo $url; ?>" class="feature-img" title="<?php echo $title; ?>">
						<div class="feature-img-bg" style="background-image: url(<?php echo check_https( $image ); ?>);">
						</div>
					</a>
					<h3>
						<a href="<?php echo $url ; ?>">
							<?php echo $title; ?>
						</a>
					</h3>
					<p><?php echo $text; ?></p>
				</div>
			<?php } ?>
		</div>
	</article>
</div>
<?php } ?>