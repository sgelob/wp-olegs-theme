<?php
    /*
    @package Olegs
    */
get_header(); ?>
<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

<section id="boxes-grid">
	<main class="wrap" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="https://schema.org/Blog">
		<section class="genre-block">
			<header>
				<h1><?php echo $term->name; ?></h1>
				<p><?php echo $term->description; ?></p>
			</header>
			<?php query_posts(array('post_type' => 'galleries', 'country' => $term->slug, 'posts_per_page' => 500)); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part('inc/box'); ?>
			<?php endwhile; else: ?>
			<h3>Sorry, no matched your criteria.</h3>
			<?php endif; wp_reset_query(); ?>
		</section>
		<div class="clearfix"></div>
	</main>
</section>
<?php get_footer(); ?>
