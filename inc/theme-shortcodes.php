<?php

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function jpb_gallery_shorcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if (!empty($attr['ids'])) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if (empty($attr['orderby']))
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ($output != '')
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
					'order' => 'ASC',
					'orderby' => 'menu_order ID',
					'id' => $post ? $post->ID : 0,
					'itemtag' => 'dl',
					'icontag' => 'dt',
					'captiontag' => 'dd',
					'columns' => 3,
					'size' => 'thumbnail',
					'include' => '',
					'exclude' => '',
					'link' => ''
					), $attr, 'gallery'));

	$id = intval($id);
	if ('RAND' == $order)
		$orderby = 'none';

	if (!empty($include)) {
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif (!empty($exclude)) {
		$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	} else {
		$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	}

	if (empty($attachments))
		return '';

	if (is_feed()) {
		$output = "\n";
		foreach ($attachments as $att_id => $attachment)
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html('post');
	if (!isset($valid_tags[$itemtag]))
		$itemtag = 'dl';
	if (!isset($valid_tags[$captiontag]))
		$captiontag = 'dd';
	if (!isset($valid_tags[$icontag]))
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if (apply_filters('use_default_gallery_style', true))
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>";
	$size_class = sanitize_html_class($size);
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);

	$i = 0;
	foreach ($attachments as $id => $attachment) {
		if (!empty($link) && 'file' === $link)
			$image_output = wp_get_attachment_link($id, $size, false, false);
		elseif (!empty($link) && 'none' === $link)
			$image_output = wp_get_attachment_image($id, $size, false);
		else
			$image_output = wp_get_attachment_link($id, $size, true, false);


		$image_meta = wp_get_attachment_metadata($id);

		$orientation = '';
		if (isset($image_meta['height'], $image_meta['width']))
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

		$itemtag_filtered = apply_filters('jpb_itemtag_attribute', $itemtag, array('class' => 'gallery-item'));

		$output .= empty($itemtag_filtered) ? "<{$itemtag} class='gallery-item'>" : $itemtag_filtered;

		$output .= apply_filters('jpb_image_metadata', $image_meta, $id);

//		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ($captiontag && trim($attachment->post_excerpt)) {

			$captiontag_filtered = apply_filters('jpb_captiontag', $captiontag, array('class' => 'wp-caption-text gallery-caption'));

			if (!empty($captiontag_filtered)) {
				$output .= $captiontag_filtered;
			} else {
				$output .= "<{$captiontag} class='wp-caption-text gallery-caption'>";
			}

			$output .= wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ($columns > 0 && ++$i % $columns == 0)
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}

/*
  function jpb_gallery_shorcode($attr) {

  $post = get_post();

  static $instance = 0;
  $instance++;

  if (!empty($attr['ids'])) {
  // 'ids' is explicitly ordered, unless you specify otherwise.
  if (empty($attr['orderby']))
  $attr['orderby'] = 'post__in';
  $attr['include'] = $attr['ids'];
  }

  // Allow plugins/themes to override the default gallery template.
  $output = apply_filters('post_gallery', '', $attr);
  if ($output != '')
  return $output;

  // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if (isset($attr['orderby'])) {
  $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
  if (!$attr['orderby'])
  unset($attr['orderby']);
  }

  extract(shortcode_atts(array(
  'order' => 'ASC',
  'orderby' => 'menu_order ID',
  'id' => $post ? $post->ID : 0,
  'itemtag' => 'dl',
  'icontag' => 'dt',
  'captiontag' => 'dd',
  'columns' => 3,
  'size' => 'thumbnail',
  'include' => '',
  'exclude' => '',
  'link' => ''
  ), $attr, 'gallery'));

  $id = intval($id);
  if ('RAND' == $order)
  $orderby = 'none';

  if (!empty($include)) {
  $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

  $attachments = array();
  foreach ($_attachments as $key => $val) {
  $attachments[$val->ID] = $_attachments[$key];
  }
  } elseif (!empty($exclude)) {
  $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
  $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }

  if (empty($attachments))
  return '';

  if (is_feed()) {
  $output = "\n";
  foreach ($attachments as $att_id => $attachment)
  $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
  return $output;
  }

  global $jpb_gallery_attachments, $jpb_gallery_size;

  $jpb_gallery_attachments = $attachments;
  $jpb_gallery_size = $size;

  get_template_part('templates/gallery');
  }
 */
//remove_shortcode('gallery', 'gallery_shortcode');
//add_shortcode('gallery', 'jpb_gallery_shorcode');
