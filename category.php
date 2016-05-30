<?php 
	
	/*
	@package Olegs
	*/
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
	<div class="about-content">
		<header>
			<h1 itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<p><a rel="author" href="/about/"><?php $author = get_the_author(); echo $author; ?></a>
				<span class="sep">·</span>
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('d/m/Y'); ?></time>
				<span class="sep">·</span>
				<span><?php _e('Articolo in', 'olegs'); ?> <?php the_category(', ') ?></span>
			</p>
		</header>
		<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else : ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; ?>
          
<?php get_footer(); ?>