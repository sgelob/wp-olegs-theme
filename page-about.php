<?php 
	
	/*
	@package Olegs
	Template Name: About
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
  
  @media all and (min-width: 320px) and (min-resolution: 2dppx) {
    .gallery-cover {
      background-image: url( <?php echo $thumb_url_large; ?> );
    }
  }

  @media all and (min-width: 768px) {
    .gallery-cover {
      background-image: url( <?php echo $thumb_url_large; ?> );
    }
  }
  
  @media all and (min-width: 768px) and (min-resolution: 2dppx) {
    .gallery-cover {
      background-image: url( <?php echo $thumb_url_full; ?> );
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
				<meta itemprop="width" content="1620px">
				<meta itemprop="height" content="1080px">
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
		</article>
	</div>
</div>

<?php endwhile; // end of the loop. ?>
          
<?php get_footer(); ?>