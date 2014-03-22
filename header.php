<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <title><?php wp_title() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description') ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/favicon.ico">
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
