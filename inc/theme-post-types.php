<?php

// Register Custom Post Types
function jpb_banner_post_type() {

	$labels = array(
		'name'                => 'Banners',
		'singular_name'       => 'Banner',
		'menu_name'           => 'Banners',
		'all_items'           => 'Todos los banners',
		'view_item'           => 'Ver banner',
		'add_new_item'        => 'A&ntilde;adir nuevo',
		'add_new'             => 'A&ntilde;adir nuevo',
		'edit_item'           => 'Editar banner',
		'search_items'        => 'Buscar banners',
		'not_found'           => 'No se encontraron banners.',
		'not_found_in_trash'  => 'Ning&uacute;n banner encontrado en la papelera.',
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
		'name'                => 'Galer&iacute;as',
		'singular_name'       => 'Galer&iacute;a',
		'menu_name'           => 'Galer&iacute;as',
		'all_items'           => 'Todas las galer&iacute;as',
		'view_item'           => 'Ver galer&iacute;a',
		'add_new_item'        => 'A&ntilde;adir nueva',
		'add_new'             => 'A&ntilde;adir nueva',
		'edit_item'           => 'Editar galer&iacute;a',
		'search_items'        => 'Buscar galer&iacute;as',
		'not_found'           => 'No se encontraron galer&iacuteas.',
		'not_found_in_trash'  => 'Ninguna galer&iacute;a encontrada en la papelera.',
	);
	$rewrite = array(
		'slug'                => 'gallery',
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