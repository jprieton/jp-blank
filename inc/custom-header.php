<?php

$defaults = array(
				'default-image' => '',
				'random-default' => true,
				'width' => 1170,
				'height' => 150,
				'flex-height' => false,
				'flex-width' => false,
				'default-text-color' => '',
				'header-text' => true,
				'uploads' => true,
				'wp-head-callback' => '',
				'admin-head-callback' => '',
				'admin-preview-callback' => '',
);
add_theme_support('custom-header', $defaults);

register_default_headers(
		array(
						'blue' => array(
										'url' => '%s/images/headers/blue.png',
										'thumbnail_url' => '%s/images/headers/blue-thumbnail.png',
										'description' => __('Blue', 'jpb')
						),
						'green' => array(
										'url' => '%s/images/headers/green.png',
										'thumbnail_url' => '%s/images/headers/green-thumbnail.png',
										'description' => __('Green', 'jpb')
						),
						'purple' => array(
										'url' => '%s/images/headers/purple.png',
										'thumbnail_url' => '%s/images/headers/purple-thumbnail.png',
										'description' => __('Purple', 'jpb')
						),
						'red' => array(
										'url' => '%s/images/headers/red.png',
										'thumbnail_url' => '%s/images/headers/red-thumbnail.png',
										'description' => __('Red', 'jpb')
						),
						'yellow' => array(
										'url' => '%s/images/headers/yellow.png',
										'thumbnail_url' => '%s/images/headers/yellow-thumbnail.png',
										'description' => __('Yellow', 'jpb')
						),
		)
);
