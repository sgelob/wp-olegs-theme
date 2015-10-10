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
	<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
		<header class="gallery-cover">
			<div>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			<p><?php _e('by', 'olegs'); ?> <a rel="author" href="/about/"><?php $author = get_the_author(); echo $author; ?></a> · 
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('F j, Y'); ?></time>
				<span><?php _e('Gallery in', 'olegs'); ?> <?php the_terms( $post->ID, 'genre', '', '', '' ); ?> – <?php the_terms( $post->ID, 'country', '', '', '' ); ?></span>
			</p>
			</div>
		</header>
	
	<div class="gallery-content">
		<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<section class="share">
			<header>
				<h3><?php _e('Share this gallery', 'olegs'); ?></h3>
			</header>
			<a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>" target="_blank"><?php _e('Share on Facebook', 'olegs'); ?></a>
			<a class="share-twitter" href="https://twitter.com/intent/tweet/?text=<?php echo urlencode(get_the_title($post->ID)); ?>&url=<?php echo urlencode(wp_get_shortlink($post->ID)); ?>&via=sgelob&hashtags=photography,<?php $terms_as_text = get_the_term_list( $post->ID, 'genre', '', ', ', '' ); echo strip_tags(preg_replace('/\s+/', '', $terms_as_text)); ?>" target="_blank"><?php _e('Share on Twitter', 'olegs'); ?></a>
			<a class="share-google" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink($post->ID)); ?>" target="_blank"><?php _e('Share on Google+', 'olegs'); ?></a>
		</section>
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
				$found_none = _e('<h2>No related galleries found!</h2>', 'olegs');
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
				if ($found_none) {
					echo $found_none;
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