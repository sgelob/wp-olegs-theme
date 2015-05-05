<?php 
	
	/*
	@package Olegs
	Template Name: About
	*/
	get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php // Get attachment original size image URL
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$thumb_url = $thumb['0'];
	?>
	
	<section class="gallery-cover" style="background-image: url( <?php echo $thumb_url; ?> );">
		<header>
			<section class="vertical-align">
				<h2>Get in touch</h2>
			<?php wp_nav_menu( array( 
					'theme_location' => 'footer-social',
					'container' => false,
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul class="about-get-in-touch">%3$s</ul>',
					'echo' => true,
		) );
				?>
			</section>
			<div>
				<h1><strong><?php the_title(); ?></strong> <br><span><?php the_excerpt_rss(); ?></span></h1>
			</div>
		</header>
	</section>
	
	<section class="about-content">
		<article>
			<?php the_content(); ?>
		</article>
	</section>

<?php endwhile; // end of the loop. ?>
          
<?php get_footer(); ?>