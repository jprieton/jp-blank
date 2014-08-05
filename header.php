<!doctype html>
<html <?php language_attributes() ?>>
	<head>
    <meta charset="<?php bloginfo('charset') ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php bloginfo('description') ?>" />

    <title><?php wp_title() ?></title>

		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" />
		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri() ?>/apple-touch-icon.png" />

		<?php jpb_canonical_meta() ?>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
		<!-- Animate.css -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
		<!-- Main Theme Styles -->
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" />

		<?php wp_head() ?>

  </head>

  <body <?php body_class() ?>>
		<div class="container">
			<div id="site-header">
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="Logo" rel="logo" class="img-responsive">
				</a>
			</div>
		</div>
