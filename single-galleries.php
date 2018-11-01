<?php
	/*
	@package Olegs
	*/
get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'inc/background-image' ); ?>
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
			<p><?php _e('by', 'olegs'); ?> <span itemprop="name"><?php $author = get_the_author(); echo $author; ?></span> •
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('Y/m/d'); ?></time>
				<meta itemprop="dateModified" content="<?php the_modified_date('c'); ?>"/>
				<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization"/>
					<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						<meta itemprop="url" content="<?php echo get_stylesheet_directory_uri(); ?>/img/olegs-belousovs-portrait.jpg">
						<meta itemprop="width" content="1200px">
						<meta itemprop="height" content="1200px">
    				</span>
					<meta itemprop="name" content="<?php $author = get_the_author(); echo $author; ?>">
				</span>
				<span>• <?php _e('Gallery in', 'olegs'); ?> <?php the_terms( $post->ID, 'genre', '', '', '' ); ?> – <span itemprop="contentLocation"><?php the_terms( $post->ID, 'country', '', '', '' ); ?></span></span>
			</p>
			</div>
		</header>

	<div class="gallery-content">
		<p class="excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<p class="scroll-top"><a href="#top"><?php _e('⇡ Back to top', 'olegs'); ?></a></p>
<!--
		<div class="clearfix"></div>
		<section class="share">
			<header>
				<h3><?php _e('Share This Gallery', 'olegs'); ?></h3>
			</header>
			<?php get_template_part( 'inc/share' ); ?>
		</section>
-->
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
			<div itemscope itemtype="http://schema.org/WebPage">
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
			</div>
		</section>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else: ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; wp_reset_query(); ?>

<?php get_footer(); ?>
