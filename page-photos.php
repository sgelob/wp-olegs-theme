<?php 
	/*
	@package Olegs
	Template Name: Photos
	*/
get_header(); ?>
<!--
<?php while ( have_posts() ) : the_post(); ?>
<section class="about-content">
	<article>
		<?php the_content(); ?>
	</article>
</section>
<?php endwhile; // end of the loop. ?>
-->

<section id="boxes-grid">
	<main class="wrap" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="https://schema.org/Blog">
		<?php
			/*
			* Loop through Categories and Display Posts within
			*/
			// $taxonomies = get_object_taxonomies( array( 'post_type' => 'galleries' ) );
			$taxonomies = array( 'genre' );
			foreach( $taxonomies as $taxonomy ) :
			// Gets every "category" (term) in this taxonomy to get the respective posts
			$terms = get_terms( $taxonomy );
			foreach( $terms as $term ) : $term_link = get_term_link( $term ); ?>
			<section class="genre-block">
				<header>
					<h1><a href="<?php echo $term_link; ?>" title="Show me all the galleries in “<?php echo $term->name; ?>” category"><?php echo $term->name; ?></a></h1>
					<p><?php echo $term->description; ?></p>
				</header>
				<?php
					$args = array(
						'no_found_rows' => true,
						'update_post_meta_cache' => false,
						'post_type' => 'galleries',
						'posts_per_page' => 4,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'genre',
								'field' => 'slug',
								'terms' => $term->slug,
							)
						)
					);
					$posts = new WP_Query($args);
					if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post(); ?>
					<?php get_template_part( 'inc/box' ); ?>
				<?php endwhile; endif; wp_reset_query(); ?>
			</section>
			<div class="clearfix"></div>
		<?php endforeach; endforeach; ?>
		
		
		<section class="genre-block">
			<header>
				<h1><a href="https://www.instagram.com/sgelob/" title="Olegs Belousovs (@sgelob) • Foto e video di Instagram">Instagram</a></h1>
				<p>My camera phone photographs from around the world.</p>
			</header>
			<?php echo do_shortcode( '[instagram-feed]' ); ?>
		</section>
<div class="clearfix"></div>
	</main>
</section>
          
<?php get_footer(); ?>