<?php

// Remove blank space when is inline-block
add_filter('wp_nav_menu', function($str) {
	$str = str_replace(array("\n"), array(''), $str);
	return $str;
});

function jpb_attribute_output_filter($attr)
{
	$output = array();
	foreach ($attr as $key => $value) {
		$output[] = (empty($value)) ? esc_attr($key) : esc_attr($key) . '=\'' . esc_attr($value) . '\'';
	}
	return implode(' ', $output);
}

add_filter('jpb_attribute_output', 'jpb_attribute_output_filter');

function jpb_post_thumbnail_class_filter($attr)
{
	$attr['class'] .= ' img-thumbnail img-responsive';
	return $attr;
}

function jpb_image_metadata_filter($image_meta, $id)
{
	$metadata = '';
	$metadata .= empty($image_meta['width']) ? '' : "<meta itemprop='width' content='{$image_meta['width']}'>";
	$metadata .= empty($image_meta['height']) ? '' : "<meta itemprop='height' content='{$image_meta['height']}'>";
	$metadata .= "<meta itemprop='image' content='" . wp_get_attachment_url($id) . "'>";
	return $metadata;
}

function jpb_itemtag_attribute_filter($itemtag, $attrs)
{
	$attrs['itemscope'] = '';
	$attrs['itemtype'] = 'http://schema.org/ImageObject';
	$output = apply_filters('jpb_attribute_output', $attrs);
	return "<{$itemtag} {$output}>";
}

function jpb_captiontag_filter($captiontag, $attrs)
{
	$attrs['itemprop'] = 'caption';
	$output = apply_filters('jpb_attribute_output', $attrs);
	return "<{$captiontag} {$output}>";
}

function jpb_post_thumbnail_itemprop_filter($attr)
{
	$attr['itemprop'] = 'thumbnailUrl';
	return $attr;
}

function jpb_gallery_style($var)
{
	$var = trim(str_replace(array('<div', '>'), '', $var));

	$div_attr = explode('\' ', $var);

	$attrs = array();
	foreach ($div_attr as $attr) {
		$_attr = explode('=', $attr);
		$attrs[$_attr[0]] = trim(str_replace('\'', '', $_attr[1]));
	}

	$attrs['itemscope'] = '';
	$attrs['itemtype'] = 'http://schema.org/ImageGallery';

	$attrs = apply_filters('jpb_gallery_attributes', $attrs);

	$output = apply_filters('jpb_attribute_output', $attrs);

	return '<div ' . $output . ' >';
}
