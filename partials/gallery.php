<?php if (get_field('gallery')) { ?>
<div id="slides" class="entry-content entry-media-gallery clearfix">
	<h2>Document gallery</h2>
	<ul class="images">
		<?php while(the_repeater_field('gallery')): ?>
			<?php $thumb = wp_get_attachment_image_src(get_sub_field('imageGallery'), 'thumbnail'); ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('imageGallery'), 'large'); ?>
			<li>
				<div class="thumbImage">
					<img class="zoomIcon" alt="Zoom" src="<?php echo get_stylesheet_directory_uri(); ?>/img/zoom.png"  />
					<a href="<?php echo $image[0]; ?>" title="<?php  the_sub_field('caption');?>" class="imageThumbsGroup" >
						<img src="<?php echo $thumb[0]; ?>" alt="Image of <?php  the_sub_field('caption');?>">
					</a>
				</div>
				<div class="imageContent">
					<h4><?php  the_sub_field('caption');?></h4>
					<p><?php  the_sub_field('reference');?></p>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>
</div>
<?php } ?>