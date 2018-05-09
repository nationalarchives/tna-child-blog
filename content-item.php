<?php
$image = get_feature_image_url( get_the_ID(), 'feature-box-thumb', true );
if ( in_category('video')) {
	$icon = '<div class="icon-circle icon-video"></div>';
} elseif ( in_category('audio')) {
	$icon = '<div class="icon-circle icon-audio"></div>';
} else {
	$icon = '';
}
?>
<div class="latest-post col-md-4">
	<a href="<?php echo get_permalink(); ?>" class="feature-img" title="<?php the_title(); ?>">
		<div class="feature-img-bg" <?php echo $image; ?>>
			<?php echo $icon; ?>
		</div>
	</a>
	<?php
	if ( is_amp() ) {
		if ( in_category('video')) {
			echo '<div class="content-type">Video</div>';
		} elseif ( in_category('audio')) {
			echo '<div class="content-type">Audio</div>';
		}
	}
	?>
	<h3>
		<a href="<?php echo get_permalink(); ?>">
			<?php the_title(); ?>
		</a>
	</h3>
	<div class="entry-meta">
		<p>
			<?php the_entry_meta( array(
				'cat'       => false,
				'home'      => true
			) ); ?>
		</p>
	</div>
	<p>
		<?php echo trim( substr( get_the_excerpt(), 0, 160 ) ) . '...'; ?>
		<a href="<?php the_permalink(); ?>">read more</a>
	</p>
</div>