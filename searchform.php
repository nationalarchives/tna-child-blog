<?php if ( is_amp() ) {
    $placeholder = 'Search Archives Media Player';
} else {
    $placeholder = 'Search our blog';
} ?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
        <label class="screen-reader-text" for="s"><?php echo _x( 'Search for:', 'label' ); ?></label>
        <input type="text" placeholder="<?php echo esc_attr_x( $placeholder, 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
    </div>
</form>