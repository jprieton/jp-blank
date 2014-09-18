<?php

/**
 * Dumps information about the variable wrapped in &lt;pre&gt; tag and, optionally, terminate the current script.
 *
 * @param mixed $var The variable you want to dump.
 * @param bool $stop If true terminate the current script.
 * @return void
 */
function jpb_debug($var, $stop = false)
{
	echo '<pre>';
	var_dump($var);
	echo '</pre>';

	if ($stop) {
		die();
	}
}

if (!function_exists('debug')) {

	/**
	 * An alias of jpb_debug().
	 *
	 * @param mixed $var The variable you want to dump.
	 * @param bool $stop If true terminate the current script.
	 * @return void
	 */
	function debug($var, $stop = false)
	{
		jpb_debug($var, $stop);
	}

}

/**
 * Returns url stylesheet, Switch between CDN an local files based in constant JPB_USE_CDN
 * @param string $local_path
 * @param string $remote_path (optional)
 * @return type string If not set $remote_path and the constant JPB_USE_CDN is <i>true</i> returns $local_path
 */
function jpb_switch_cdn($local_path, $remote_path = '')
{
	if (!empty($remote_path) && (bool) JPB_USE_CDN) {
		return $remote_path;
	} else {
		return $local_path;
	}
}

/**
 * Store theme messages and alerts
 * @global type $jpb_messages
 * @param string $message
 * @param string $type
 * @param bool $dismissable
 */
function jpb_add_message($message, $type = 'info', $dismissable = false)
{
	global $jpb_messages;

	switch ($type) {
		case 'success':
			$jpb_messages[] = array(
					'class' => 'alert-success',
					'content' => $message,
					'dismissable' => (bool) $dismissable
			);
			break;
		case 'warning':
			$jpb_messages[] = array(
					'class' => 'alert-warning',
					'content' => $message,
					'dismissable' => (bool) $dismissable
			);
			break;
		case 'danger':
			$jpb_messages[] = array(
					'class' => 'alert-danger',
					'content' => $message,
					'dismissable' => (bool) $dismissable
			);
			break;

		case 'info':
		default:
			$jpb_messages[] = array(
					'class' => 'alert-info',
					'content' => $message,
					'dismissable' => (bool) $dismissable
			);
			break;
	}
}

/**
 * Show messages and alerts
 * @global array $jpb_messages
 */
function jpb_show_message()
{
	global $jpb_messages;
	$str_message = '';
	foreach ($jpb_messages as $item) {
		if ($item['dismissable']) {
			$str_message .= sprintf('<div class="alert %s alert-dismissable">', $item['class']);
			$str_message .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		} else {
			$str_message .= sprintf('<div class="alert %s">', $item['class']);
		}
		$str_message .= $item['content'];
		$str_message .= '</div>';
	}
	echo $str_message;
	$jpb_messages = array();
}

/**
 * Dummy function
 * @return null
 */
function jpb_dummy()
{
	return;
}

/**
 * Add a thumbnail column
 */
function jpb_admin_thumbnail_column()
{
	if (is_admin()) {

		add_image_size('jpb_admin_thumb', 70, 70, true);

		add_filter('manage_posts_columns', 'posts_columns', 5);

		function posts_columns($defaults)
		{
			$defaults['jpb_thumbnail'] = 'Imagen destacada';
			return $defaults;
		}

		add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

		function posts_custom_columns($column_name, $id)
		{
			if ($column_name === 'jpb_thumbnail') {
				the_post_thumbnail(jpb_admin_thumb);
			}
		}

		add_action('admin_enqueue_scripts', 'admin_post_thumbnail');

		function admin_post_thumbnail()
		{
			?>
			<style type="text/css">
					.column-jpb_thumbnail { width: 130px }
					.column-jpb_thumbnail img { display: block; margin: auto; }
			</style>
			<?php

		}

	}
}

/**
 * Shows the canonical meta tag
 */
function jpb_canonical_meta()
{
	if (is_home()) {
		$canonical_url = home_url();
	} elseif (is_page() or is_singular()) {
		$canonical_url = get_the_permalink();
	}

	echo (!empty($canonical_url)) ? '<link rel="canonical" href="' . $canonical_url . '" />' : '';
}

/**
 * Returns an image tag with default image
 * @global array $_wp_additional_image_sizes
 * @param string $size
 * @param array $attr
 * @return string
 */
function jpb_get_default_image($size = 'thumbnail', $attr = array())
{
	global $_wp_additional_image_sizes;
	if (in_array($size, array('thumbnail', 'medium', 'large'))) {
		$w = get_option($_size . '_size_w');
		$h = get_option($_size . '_size_h');
	} else {
		if (!empty($_wp_additional_image_sizes[$size])) {
			$w = $_wp_additional_image_sizes[$size]['width'];
			$h = $_wp_additional_image_sizes[$size]['height'];
		} else {
			$w = $h = 0;
		}
	}

	if (empty($attr['src'])) {
		$src = apply_filters('jpb_default_image', get_stylesheet_directory_uri() . '/images/no-image.png');
		$src .= (($w + $h) > 0 && $timthumb_htaccess) ? "?w={$w}&h={$h}" : '';
		$attr['src'] = esc_attr($src);
	}

	if (empty($attr['alt'])) {
		$attr['alt'] = 'Sin imagen';
	}

	if (empty($attr['width']) && $w > 0) {
		$attr['width'] = $w;
	}

	if (empty($attr['height']) && $h > 0) {
		$attr['height'] = $h;
	}

	$img = '<img';

	foreach ($attr as $key => $value) {
		$img .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
	}

	$img .= '>';

	return $img;
}

/* ------------------------------------------------------------ */

function jpb_featured_image_src($post_id = NULL, $size = NULL)
{
	if (has_post_thumbnail($post_id)) {

	} else {
		return FALSE;
	}
}

function jpb_style_uri($style = '')
{

	$style_url = null;
	switch ($style) {
		case 'bootstrap':
			$style_url = (JPB_USE_CDN) ?
							'//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' :
							get_template_directory_uri() . '/css/bootstrap.min.css';
			break;

		default:
			break;
	}

	return $style_url;
}

/**
 * Returns url javascript file, local or cdn, based in constant JPB_USE_CDN
 * @param string $style
 * @return type string
 */
function jpb_script_uri($style = '')
{

	$script_url = null;
	switch ($style) {
		case 'bootstrap':
			$script_url = (JPB_USE_CDN) ?
							'//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js' :
							get_template_directory_uri() . '/js/bootstrap.min.js';
			break;
		case 'jquery':
			$script_url = (JPB_USE_CDN) ?
							'//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js' :
							get_template_directory_uri() . '/js/jquery.min.js';
			break;
		case 'modernizr':
			$script_url = (JPB_USE_CDN) ?
							'//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js' :
							get_template_directory_uri() . '/js/modernizr.min.js';
			break;

		default:
			break;
	}

	return $script_url;
}
