<?php 
	
	/*
	@package Olegs
	Template Name: Landing
	*/
get_header(); ?>	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<article role="main">
		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>"/>
	<div class="about-content">
		<header>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
		</header>
		<p class="excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<p class="scroll-top"><a href="#top"><?php _e('⇡ Torna su', 'olegs'); ?></a></p>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else: ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>