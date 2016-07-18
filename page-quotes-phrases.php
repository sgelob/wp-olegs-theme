<?php 
	
	/*
	@package Olegs
	Template Name: Quotes & Phrases
	*/
get_header(); ?>	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php // Get attachment image URLs
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
			<p><?php _e('by', 'olegs'); ?> <a itemprop="author" itemprop="publisher" itemscope itemtype="https://schema.org/Person" rel="author" href="/about/"><span itemprop="name"><?php $author = get_the_author(); echo $author; ?></span></a> • 
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('F j, Y'); ?></time>
				<meta itemprop="dateModified" content="<?php the_modified_date('c'); ?>"/>
				<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization"/>
					<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						<meta itemprop="url" content="<?php echo get_stylesheet_directory_uri(); ?>/img/olegs-belousovs-portrait.jpg">
						<meta itemprop="width" content="1200">
						<meta itemprop="height" content="1200">
    				</span>
					<meta itemprop="name" content="<?php $author = get_the_author(); echo $author; ?>">
				</span>
			</p>
			</div>
		</header>
	
	<div class="gallery-content">
		<p class="excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
		
		<?php
			$args = array(
				'post_type' => 'quotes',
				'orderby' => 'rand',
				'posts_per_page' => -1
			);
			$the_query = new WP_Query($args);
			if( $the_query->have_posts() ): while( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<blockquote itemprop="mentions" itemscope itemtype="http://schema.org/Article">
				<?php the_content(); ?>
				<footer><?php 
					$quote_sources = wp_get_object_terms( $post->ID,  'quote-author' );
						if ( ! empty( $quote_sources ) ) {
							if ( ! is_wp_error( $quote_sources ) ) {
								echo '— <cite itemprop="author">';
									foreach( $quote_sources as $term ) {
										echo esc_html( $term->name );
									}
								echo '</cite>';
							}
						}
					?>
				</footer>
			</blockquote>
			<div class="clearfix"></div>
<?php endwhile; else: ?>
	<h3>Sorry, no matched your criteria.</h3>
<?php endif; wp_reset_query(); ?>

		
		<div class="clearfix"></div>
		<p class="scroll-top"><a href="#top"><?php _e('⇡ Back to top', 'olegs'); ?></a></p>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else: ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>