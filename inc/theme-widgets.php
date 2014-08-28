<?php

class JPB_Widget_Login extends WP_Widget
{

	public function __construct()
	{
		$widget_ops = array('description' => __('A JPB Login Widget', 'jpb'), 'classname' => 'jpb_widget_login');
		parent::__construct('jpb_login', __('JPB Login Widget', 'jpb'), $widget_ops);
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = esc_attr($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	public function widget($args, $instance)
	{
		extract($args);
		if (is_user_logged_in()) {
			global $current_user;
//			$current_user = get_currentuserinfo();
//			deb
			echo $before_title;
			_e('Welcome', 'jpb');
			echo ', ' . $current_user->display_name . $after_title;
			return;
		}

		echo $before_widget;

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Log In') : $instance['title'], $instance, $this->id_base);
		if ($title) echo $before_title . $title . $after_title;
		?>
		<form role="form" action="<?php home_url() ?>" method="post">
			<div class="form-group">
				<label for="user_login">Email address</label>
				<input type="email" id="user_login" name="user_login" class="form-control" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="user_password">Password</label>
				<input type="password" id="user_password" name="user_password" class="form-control" placeholder="Password">
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> Remember Me
				</label>
			</div>
			<input type="hidden" name="jpb_login_form" value="1">
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		</li>
		<?php
		echo $after_widget;
	}

}

function jpb_login_submit()
{

	$user_login = filter_input(INPUT_POST, 'user_login');
	$user_password = filter_input(INPUT_POST, 'user_password');
	$remember = (bool) filter_input(INPUT_POST, 'remember');
	$is_login = (bool) filter_input(INPUT_POST, 'jpb_login_form');

	if ($is_login && !empty($user_login) && !empty($user_password)) {
		$creds = array();
		$creds['user_login'] = $user_login;
		$creds['user_password'] = $user_password;
		$creds['remember'] = $remember;
		$user = wp_signon($creds, false);

		if (is_wp_error($user)) {
			die('no');
			return FALSE;
		} else {
			echo '<script type="text/javascript">window.location = "' . home_url() . '";</script>';
			return TRUE;
		}
	}
}

// end my_theme_send_email
add_action('init', 'jpb_login_submit');

/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
						'foo_widget', // Base ID
						__('Widget Title', 'text_domain'), // Name
						array('description' => __('A Foo Widget', 'text_domain'),) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);

		echo $args['before_widget'];
		if (!empty($title)) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo __('Hello, World!', 'text_domain');
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('New title', 'text_domain');
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';

		return $instance;
	}

}

// class Foo_Widget
// register Foo_Widget widget
function register_foo_widget()
{
	register_widget('Foo_Widget');
	register_widget('JPB_Widget_Login');
}

add_action('widgets_init', 'register_foo_widget');

register_sidebar(array(
		'name' => 'Before Posts Widget',
		'id' => 'before-post',
		'description' => __('Your Widget Description.', '$text_domain'),
));
