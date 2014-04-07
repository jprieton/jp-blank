<?php

if (!function_exists('debug')) {

	/**
	 * Dumps information about a variable wrapped in &lt;pre&gt; tag and, optionally, terminate the current script.
	 *
	 * @param mixed $var The variable you want to dump.
	 * @param bool $stop If true terminate the current script.
	 * @return void
	 */
	function debug($var, $stop = true) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
		($stop || exit);
	}

}

/**
 * Returns url stylesheet, local or cdn, based in constant JPB_USE_CDN
 * @param string $style
 * @return type string
 */
function jpb_style_uri($style = '') {

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
function jpb_script_uri($style = '') {

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

/**
 * Dummy function
 * @return null
 */
function jpb_dummy() {
	return;
}

/**
 * Store theme messages and alerts
 * @global type $jpb_messages
 * @param string $message
 * @param string $type
 * @param bool $dismissable
 */
function add_message($message, $type = 'info', $dismissable = false) {
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
function show_message() {
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


