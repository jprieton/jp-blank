<?php the_post() ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1><?php the_title() ?></h1>
	</header>

	<div class="post-content">
		<?php the_content() ?>
	</div><!-- .post-content -->

	<footer>

	</footer>

</article><!-- #post-## -->