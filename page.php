<?php 
	
	/*
	@package Olegs
	*/
get_header(); ?>
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
		<header class="gallery-cover">
			<div>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			<p>by <a rel="author" href="/about/">Olegs Belousovs</a> · 
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('F j, Y'); ?></time>
			</p>
			</div>
		</header>
	<div class="gallery-content">
		<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
		<?php the_content(); ?>
		<div class="clearfix"></div>
	</div>
	</article>
<?php endwhile; else: ?>
	<h3>Sorry, no matched your criteria.</h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>