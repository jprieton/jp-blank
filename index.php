<?php

get_header();

while (have_posts()) {
	get_template_part('content');
}

get_footer();
