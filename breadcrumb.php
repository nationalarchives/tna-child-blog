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
					<span class="sep">&gt;</span>
					<span class="current">
						<?php
						if ( is_search() ) {
							echo 'Search results found for: ';
							the_search_query();
						} else {
							the_title();
						} ?>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>