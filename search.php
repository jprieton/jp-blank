<?php get_header() ?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<h2><?php printf(__('Search Results for: %s'), '<span>' . get_search_query() . '</span>'); ?></h2>
			<?php
			while (have_posts()) {
				get_template_part('content');
			}
			?>
		</div>
		<div class="col-md-3">
			<?php get_sidebar() ?>
		</div>
	</div>

</div>
<?php
get_footer();
