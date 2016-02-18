<?php 
	
	/*
	@package Olegs
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
	<article itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>"/>
		<header class="gallery-cover">
			<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo $thumb_url_full; ?>">
			</span>
			<div>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			<p><?php _e('by', 'olegs'); ?> <a itemprop="author" itemscope itemtype="https://schema.org/Person" rel="author" href="/about/"><span itemprop="name"><?php $author = get_the_author(); echo $author; ?></span></a> · 
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('F j, Y'); ?></time>
				<span><?php _e('Gallery in', 'olegs'); ?> <?php the_terms( $post->ID, 'genre', '', '', '' ); ?> – <?php the_terms( $post->ID, 'country', '', '', '' ); ?></span>
			</p>
			</div>
		</header>
	
	<div class="gallery-content">
		<p class="excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<?php get_template_part( 'inc/share' ); ?>
		<div class="clearfix"></div>
		<section class="comments">
			<header>
				<h3><?php _e('Leave Your Comments', 'olegs'); ?></h3>
			</header>
			<?php comments_template( '', true ); ?>
		</section>
		<section class="related">
			<header>
				<h3><?php _e('See the Related Galleries', 'olegs'); ?></h3>
			</header>
			<?php
				$backup = $post;  // backup the current object
				$taxonomy = 'genre';//  e.g. post_tag, category, custom taxonomy
				$param_type = 'genre'; //  e.g. tag__in, category__in, but genre__in will NOT work
				$tax_args = array('orderby' => 'none');
				$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
				if ($tags) {
					foreach ($tags as $tag) {
						$args = array(
							"$param_type" => $tag->slug,
							'post__not_in' => array($post->ID),
							'post_type' => 'galleries',
							'posts_per_page' => 4,
							'orderby' => 'rand',
							'caller_get_posts'=>1
						);
						$my_query = null;
						$my_query = new WP_Query($args);
						if( $my_query->have_posts() ) {
							while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<?php get_template_part( 'inc/box' ); ?>
							<?php $found_none = '';
								endwhile;
						}
					}
				}
				$post = $backup;  // copy it back
				wp_reset_query(); // to use the original query again
			?>
		</section>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else: ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>