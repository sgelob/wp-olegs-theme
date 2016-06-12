<?php 
	
	/*
	@package Olegs
	Template Name: What I Do
	*/
	get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
	<?php // Get attachment original size image URL
		$thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$thumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$thumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
		$thumb_url_full = $thumb_full['0'];
		$thumb_url_large = $thumb_large['0'];
		$thumb_url_medium = $thumb_medium['0'];
	?>
	
	<style>
		.gallery-cover {
			background-image: url( <?php echo $thumb_url_medium; ?> );
		}
		
		@media all and (min-width: 768px) {
			.gallery-cover {
				background-image: url( <?php echo $thumb_url_large; ?> );
			}
		}
		
		@media all and (min-width: 992px) {
			.gallery-cover {
				background-image: url( <?php echo $thumb_url_full; ?> );
			}
		}
	</style>
	
<div itemscope itemtype="https://schema.org/Person">
	<section class="gallery-cover h-card">
		<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo $thumb_url_full; ?>">
				<meta itemprop="width" content="1620">
				<meta itemprop="height" content="1080">
			</span>
		<header>
			<div class="vertical-align">
				<h2><?php $theshorttitle = get_post_meta($post->ID, 'about_contacts_title', true); echo $theshorttitle; ?></h2>
			<?php wp_nav_menu( array( 
					'theme_location' => 'footer-social',
					'container' => false,
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul class="about-get-in-touch">%3$s</ul>',
					'echo' => true,
					'walker' => new My_Walker_Nav_Menu(),
		) );
				?>
			</div>
			<div>
				<h1>
					<span itemprop="name" class="p-name"><strong><?php the_title(); ?></strong></span>
					<br>
					<span itemprop="jobTitle" class="p-role"><?php the_excerpt_rss(); ?></span>
				</h1>
			</div>
		</header>
	</section>
	
	<div class="about-content">
		<article>
			<?php the_content(); ?>
			
			<ul class="what-i-do">
			<?php
			$args = array(
				'post_type' => 'services',
				'orderby' => 'menu_order',
				'posts_per_page' => -1,
				'order' => 'ASC'
			);
			$the_query = new WP_Query($args);
			if( $the_query->have_posts() ): while( $the_query->have_posts() ) : $the_query->the_post(); ?>
			
			<li class="what-i-do__item">
			<a href="<?php $whatidourl = get_post_meta($post->ID, 'what-i-do_link', true); echo $whatidourl; ?>" class="what-i-do__link">
				<h3><?php the_title(); ?></h3>
				<p><?php the_content(); ?></p>
			</a>
			</li>
			
			<?php endwhile; else: ?>
			<h3>Sorry, no matched your criteria.</h3>
			<?php endif; wp_reset_query(); ?>
			
			</ul><!-- what-i-do -->
			
			<p class="align-center"><a class="btn" href="mailto:olegs.belousovs@gmail.com" role="button"><?php _e('Mettiamoci in contatto', 'olegs'); ?></a></p>
		</article>
	</div>
</div>

<?php endwhile; // end of the loop. ?>
          
<?php get_footer(); ?>