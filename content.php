<?php the_post() ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

	<header>
		<h1 itemprop="name"><?php the_title() ?></h1>
	</header>

	<div class="post-content" itemprop="articleBody">
		<?php the_content() ?>
	</div><!-- .post-content -->

	<footer>

	</footer>

	<meta itemprop="datePublished" content="<?php echo get_the_date('i') ?>">
	<meta itemprop="author" content="<?php echo esc_attr(get_the_author()) ?>">
	<meta itemprop="url" content="<?php the_permalink() ?>">

</article><!-- #post-## -->