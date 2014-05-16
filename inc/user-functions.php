<?php

/**
 * Change the user pasword using
 * @global type $current_user
 * @return boolean
 */
function jpb_change_user_pass() {

	$old_password = filter_input(INPUT_POST, 'old_password');
	$new_password = filter_input(INPUT_POST, 'new_password');
	$confirm_pasword = filter_input(INPUT_POST, 'confirm_password');

	if (empty($old_password) or empty($new_password) or ($new_password != $confirm_pasword) or !is_user_logged_in()) {
		return FALSE;
	}

	global $current_user;
	get_currentuserinfo();

	if (empty($current_user)) {
		return FALSE;
	}

	$creds = array(
					'user_login' => $user_login,
					'user_password' => $old_password
	);
	$user = wp_signon($creds, false);

	if (is_wp_error($user)) {
		// Do something if $old pass is incorrect
		return FALSE;
	} else {
		// Update pass
		wp_update_user(array('ID' => $current_user->ID, 'user_pass' => $new_password));
		return TRUE;
	}
}

// run it before the headers and cookies are sent
if (is_user_logged_in()) {
	add_action('after_setup_theme', 'jpb_validate_login');
}

/**
 * Closes the current session and redirect to Home
 */
function jpb_logout() {
	$logout = (bool) filter_input(INPUT_GET, 'logout');

	if ($logout) {
		wp_logout();
		echo '<script type="text/javascript">window.location = "' . home_url() . '";</script>';
	}
}

// run it before the headers and cookies are sent
if (is_user_logged_in()) {
	add_action('after_setup_theme', 'jpb_logout');
}

/**
 * Authenticates a user with option to remember credentials
 * @return boolean
 */
function jpb_login() {
	$user_login = filter_input(INPUT_POST, 'user_login');
	$user_password = filter_input(INPUT_POST, 'user_password');
	$remember = (bool) filter_input(INPUT_POST, 'remember');

	if (!empty($user_login) && !empty($user_password)) {
		$creds = array(
						'user_login' => $user_login,
						'user_password' => $user_password,
						'remember' => $remember
		);
		$user = wp_signon($creds, false);

		if (is_wp_error($user)) {
			// Do something if is incorrect
			return FALSE;
		} else {
			echo '<script type="text/javascript">window.location = "' . home_url() . '";</script>';
			return TRUE;
		}
	}
}

// run it before the headers and cookies are sent
if (!is_user_logged_in()) {
	add_action('after_setup_theme', 'jpb_login');
}

