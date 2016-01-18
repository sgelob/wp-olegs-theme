<?php 
	
	/*
	@package Olegs
	Template Name: Blog
	*/
get_header(); ?>
	
	<?php $recent_posts = new WP_Query(array('paged' => $paged, 'post_type' => 'post', 'posts_per_page' => 12, 'post_status' => 'draft'));
	if ( $recent_posts->have_posts() ) : while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
?>

	<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<div class="about-content">
		<header>
			<h1 itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<p><?php _e('by', 'olegs'); ?> <a rel="author" href="/about/"><?php $author = get_the_author(); echo $author; ?></a> · 
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('F j, Y'); ?></time>
				<span><?php _e('Article in', 'olegs'); ?> <?php the_category(', ') ?></span>
			</p>
		</header>
		<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else: ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>