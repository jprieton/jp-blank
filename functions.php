<?php

// Enqueue scripts and styles
add_action('wp_enqueue_scripts', function () {
	// Bootstrap
	wp_register_style('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css', array(), '3.3.2');
	wp_enqueue_style('bootstrap');
	wp_register_script('bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js', array('jquery'), '3.3.2', true);
	wp_enqueue_script('bootstrap');

	// Bootstrap Theme
	wp_register_style('bootstrap-theme', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css', array('bootstrap'), '3.3.2');
	wp_enqueue_style('bootstrap-theme');

	// Font Awesome
	wp_register_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array('bootstrap'), '4.3.0');
	wp_enqueue_style('font-awesome');

	// animate.css
	wp_register_style('animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css', array('bootstrap'), '3.2.0');
	wp_enqueue_style('animate');

	// hover.css
	wp_register_style('hover', get_stylesheet_directory_uri().'/css/hover-min.css', array('bootstrap'), '2.0.1');
	wp_enqueue_style('hover');

	// jQuery Form
	wp_enqueue_script('jquery-form');

	// Theme
	wp_register_style('theme', get_stylesheet_uri(), array('animate'), '1.0');
	wp_enqueue_style('theme');

	// Add defer atribute
	do_action('defer_script', array('bootstrap', 'jquery-form'));

	// Add async atribute
	do_action('async_script', array('bootstrap'));

});

// Add all supports
add_action('after_setup_theme', function () {

	// Add theme support for Automatic Feed Links
	add_theme_support('automatic-feed-links');

	// Add theme support for Post Formats
	add_theme_support('post-formats', array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat'));

	// Add theme support for Featured Images
	add_theme_support('post-thumbnails');

	// Add theme support for HTML5 Semantic Markup
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

	// Add theme support for document Title tag
	add_theme_support('title-tag');
});

// Load filters
//require_once get_template_directory() . '/includes/filters.php';


if (is_admin())
{

	add_action('admin_notices', 'jp_blank_admin_messages');

	//JP_Theme_Tools
	function jp_blank_admin_messages()
	{
		$plugin_messages = array();

		if (!is_plugin_active('jp-theme-tools/jp-theme-tools.php'))
		{
			$plugin_messages[] = 'Este tema necesita el plugin JP Theme Tools, <a href="https://github.com/jprieton/jp-theme-tools/archive/master.zip">descargalo aquí</a>.';
		}

		if (count($plugin_messages) > 0)
		{
			echo '<div id="message" class="error">';
			foreach ($plugin_messages as $message) {
				echo '<p><strong>' . $message . '</strong></p>';
			}
			echo '</div>';
		}
	}

}

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
function jpb_theme_features()
{

	// Add theme support for Translation
	load_theme_textdomain('jpb', get_template_directory() . '/languages');

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
