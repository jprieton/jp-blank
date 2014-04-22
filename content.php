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
	<meta itemprop="datePublished" content="<?php echo get_the_date('i') ?>">
	<meta itemprop="author" content="<?php echo esc_attr(get_the_author()) ?>">

</article><!-- #post-## -->