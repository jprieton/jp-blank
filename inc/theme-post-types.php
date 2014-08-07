<?php

// Register Custom Post Types
function jpb_banner_post_type() {

	$labels = array(
		'name'                => __('Banners','jpb'),
		'singular_name'       => __('Banner','jpb'),
		'menu_name'           => __('Banners','jpb'),
		'all_items'           => __('All Banners','jpb'),
		'view_item'           => __('View Banner','jpb'),
		'add_new_item'        => __('Add New', 'jpb'),
		'add_new'             => __('Add New', 'jpb'),
		'edit_item'           => __('Edit Banner','jpb'),
		'search_items'        => __('Search Banner','jpb'),
		'not_found'           => __( 'No banner found.', 'jpb' ),
		'not_found_in_trash'  => __( 'No banner found in Trash.', 'jpb' ),
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail'),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-slides',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'banner', $args );

}

// Hook into the 'init' action
// add_action( 'init', 'jpb_banner_post_type', 0 );

// Register Custom Post Type
function jpb_gallery_post_type() {

	$labels = array(
		'name'                => __('Galleries', 'jpb'),
		'singular_name'       => __('Gallery', 'jpb'),
		'menu_name'           => __('Galleries', 'jpb'),
		'all_items'           => __('All Galleries', 'jpb'),
		'view_item'           => __('View Gallery', 'jpb'),
		'add_new_item'        => _x('Add New', 'female', 'jpb'),
		'add_new'             => _x('Add New', 'female', 'jpb'),
		'edit_item'           => __('Edit Gallery', 'jpb'),
		'search_items'        => __('Search Gallery', 'jpb'),
		'not_found'           => __( 'No gallery found.', 'jpb' ),
		'not_found_in_trash'  => __( 'No gallery found in Trash.', 'jpb' ),
	);
	$rewrite = array(
		'slug'                => _x('gallery', 'url', 'jpb'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'gallery', $args );

}

// Hook into the 'init' action
// add_action( 'init', 'jpb_gallery_post_type', 0 );