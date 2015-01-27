<!doctype html>
<html <?php language_attributes() ?>>
	<head>
		<meta charset="<?php bloginfo('charset') ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="<?php bloginfo('description') ?>" />

		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" />
		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri() ?>/apple-touch-icon.png" />

		<?php wp_head() ?>
		
		<script>
      var admin_url = '<?php echo admin_url('admin-ajax.php') ?>';
		</script>

		<?php echo get_option('google-analytics', '') ?>

	</head>

	<body <?php body_class() ?> itemscope itemtype="http://schema.org/WebPage">
		<div class="container">
			<div id="site-header">
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="Logo" rel="logo" class="img-responsive">
				</a>
			</div>
		</div>
