<?php 
	/*
	@package Olegs
	Template Name: Home Page
	*/
get_header(); ?>	
<section id="boxes-grid">
	<main class="wrap" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<?php
			$paged = get_query_var('page')?get_query_var('page'):1;
			$recent_posts = new WP_Query(array(
				'paged' => $paged,
				'post_type' => 'galleries',
				'posts_per_page' => 8,
				'orderby' => 'date'
			));
			$max = $recent_posts->max_num_pages;
			wp_localize_script(
				'pbd-alp-load-posts',
				'pbd_alp',
				array(
					'startPage' => $paged,
					'maxPages' => $max,
					'nextLink' => next_posts($max, false)
				)
			);
			if ( $recent_posts->have_posts() ) : while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
		?>
	<?php get_template_part( 'inc/box' ); ?>
		<?php endwhile; endif; wp_reset_query(); ?>
	</main>
</section>
<?php get_footer(); ?>