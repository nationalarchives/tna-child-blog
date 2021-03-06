<?php if ( is_amp() ) {
	$type = 'Archives Media Player';
} else {
	$type = 'Blog';
} ?>
<div id="breadcrumb-holder" class="tna-breadcrumb">
    <div class="breadcrumbs">
        <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="http://www.nationalarchives.gov.uk/" itemprop="url">
                <span itemprop="title">Home</span>
            </a>
        </span>
        <span class="sep">&gt;</span>
        <?php if ( is_front_page() ) { ?>
        <span><?php echo $type; ?></span>
        <?php } else { ?>
        <span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $type; ?></a></span>
        <?php } ?>
        <?php if ( !is_front_page() ) { ?>
        <span class="sep">&gt;</span>
        <span class="current">
            <?php
            if ( is_search() ) {
                _e( 'Search results found for: ', 'tna-base' );
                the_search_query();
            } elseif ( is_category()  ) {
                _e( 'Category: ', 'tna-base' );
                single_cat_title();
            } elseif ( is_tag()  ) {
                _e( 'Tag: ', 'tna-base' );
                single_tag_title();
            } elseif ( is_author() ) {
                $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                _e( 'Posts by ', 'tna-base' );
                echo $curauth->display_name;
            } elseif ( is_archive()  ) {
                _e( 'Posts from ', 'tna-base' );
                single_month_title(' ');
            } elseif ( is_home() ) {
                _e( 'All posts', 'tna-base' );
            } else {
                the_title();
            } ?>
        </span>
        <?php } ?>
    </div>
</div>