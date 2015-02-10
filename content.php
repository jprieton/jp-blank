<?php the_post() ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

	<header>
		<h1 itemprop="name"><?php the_title() ?></h1>
		<div class="post-date" itemprop="datePublished" content="<?php echo get_the_date('c') ?>"><?php _e('Published on', 'jpb'); ?> <?php echo get_the_date() ?></div>
		<?php the_post_thumbnail() ?>
	</header>

	<div class="post-content" itemprop="articleBody">
		<?php the_content() ?>
	</div><!-- .post-content -->

	<footer>
		<?php
		// check if is applicable http://schema.org/genre
		the_category();
		?>

		<?php
		// check if is applicable http://schema.org/keywords
		the_tags();
		?>
	</footer>

	<meta itemprop="author" content="<?php echo esc_attr(get_the_author()) ?>">
	<meta itemprop="url" content="<?php the_permalink() ?>">

</article><!-- #post-## -->