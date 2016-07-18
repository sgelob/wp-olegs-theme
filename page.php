<?php

    /*
    @package Olegs
    */
get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php get_template_part('inc/background-image'); ?>
	<article itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost" role="main">
		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>"/>
		<header class="gallery-cover">
			<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo $thumb_url_full; ?>">
				<meta itemprop="width" content="1620">
				<meta itemprop="height" content="1080">
			</span>
			<div>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			</div>
		</header>
	<div class="about-content">
		<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<p class="scroll-top"><a href="#top"><?php _e('⇡ Torna su', 'olegs'); ?></a></p>
		<div class="clearfix"></div>
	</div>
	</article>
<?php endwhile; else: ?>
	<h3>Sorry, no matched your criteria.</h3>
<?php endif; wp_reset_query(); ?>

<?php get_footer(); ?>
