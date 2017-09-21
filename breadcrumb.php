<div id="breadcrumb-holder" class="tna-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumbs">
					<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
						<a href="http://www.nationalarchives.gov.uk/" itemprop="url">
							<span itemprop="title">Home</span>
						</a>
					</span>
					<span class="sep">&gt;</span>
					<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Blog</a></span>
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
						} else {
							the_title();
						} ?>
					</span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>