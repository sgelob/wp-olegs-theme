<?php 
	
	/*
	@package Olegs
	Template Name: Quotes
	*/
get_header(); ?>
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php // Get attachment original size image URL
		$thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$thumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$thumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
		$thumb_url_full = $thumb_full['0'];
		$thumb_url_large = $thumb_large['0'];
		$thumb_url_medium = $thumb_medium['0'];
	?>
	
	<style>
		@media all and (max-width: 767px) {
			.gallery-cover {
				background-image: url( <?php echo $thumb_url_medium; ?> );
			}
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
	</div>
	</article>
<?php endwhile; else: ?>
	<h3>Sorry, no matched your criteria.</h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>