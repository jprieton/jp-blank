<?php

/**
 * Theme constants
 */
define('JPB_USE_CDN', TRUE); // Define if scripts/styles use cdn

/**
 * Functions file
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Theme features
 */
// Register Theme Features
function jpb_theme_features() {

	// Add theme support for Translation
	load_theme_textdomain('jpb', get_template_directory() . '/languages');

	// Add theme support for Post Formats
	$formats = array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat',);
	add_theme_support('post-formats', $formats);

	// Add theme support for Featured Images
	add_theme_support('post-thumbnails');

	// Add theme support for Semantic Markup
	$markup = array('search-form', 'comment-form', 'comment-list',);
	add_theme_support('html5', $markup);

	// Add theme support for Custom Header
	include get_template_directory() . '/inc/custom-header.php';
}

// Hook into the 'after_setup_theme' action
add_action('after_setup_theme', 'jpb_theme_features');

/*
  function other_function($var1) {
  debug($var1);
  }

  add_filter('attachment_link', 'other_function', 1, 2);
 */

/* filters */
include get_template_directory() . '/inc/theme-filters.php';

/**
 * Add Boostrap classes for images thumbnails
 */
//add_filter('wp_get_attachment_image_attributes', 'jpb_post_thumbnail_class_filter');

/**
 * Add some image metadata in gallery item
 */
//add_filter('jpb_image_metadata', 'jpb_image_metadata_filter', 10, 2);

/**
 * Add microdata on item gallery
 */
//add_filter('jpb_itemtag_attribute', 'jpb_itemtag_attribute_filter', 10, 2);

/**
 * Add microdata on item gallery
 */
//add_filter('jpb_captiontag', 'jpb_captiontag_filter', 10, 2);

/**
 * Add an itemprop=thumbnailUrl to image
 */
//add_filter('wp_get_attachment_image_attributes', 'jpb_post_thumbnail_itemprop_filter');

/**
 * Remove default style gallery
 */
//add_filter('use_default_gallery_style', 'jpb_dummy');

/**
 * Add microdata on gallery
 */
//add_filter('gallery_style', 'jpb_gallery_style');


include get_template_directory() . '/inc/theme-shortcodes.php';
