<?php 
	
	/*
	@package Olegs
	Template Name: Quotes
	*/
get_header(); ?>

	<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
		<header class="gallery-cover">
			<div>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			<p><?php _e('by', 'olegs'); ?> <a rel="author" href="/about/"><?php $author = get_the_author(); echo $author; ?></a> · 
				<?php _e('Last modified:', 'olegs'); ?> <time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_modified_date(); ?></time>
			</p>
			</div>
		</header>
	<div class="about-content">
		<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
		<?php
			$args = array(
				'post_type' => 'quotes',
				'orderby' => 'rand'
			);
			$the_query = new WP_Query($args);
			if( $the_query->have_posts() ): while( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<blockquote>
				<?php the_content(); ?>
				<footer>— <cite><?php echo $term->name; ?></cite></footer>
			</blockquote>
			<div class="clearfix"></div>
<?php endwhile; else: ?>
	<h3>Sorry, no matched your criteria.</h3>
<?php endif; wp_reset_query(); ?>
</div>
	</article>
          
<?php get_footer(); ?>