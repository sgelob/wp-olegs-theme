<?php 
	
	/*
	@package Olegs
	*/
get_header(); ?>	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<article itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>"/>
	<div class="about-content">
		<header>
			<h1 itemprop="headline"><?php the_title(); ?></h1>
			<p><?php _e('by', 'olegs'); ?> <a itemprop="author" itemscope itemtype="https://schema.org/Person" rel="author" href="/about/"><span itemprop="name"><?php $author = get_the_author(); echo $author; ?></span></a>
				<span class="sep">·</span> 
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('F j, Y'); ?></time>
				<span class="sep">·</span>
				<span><?php _e('Article in', 'olegs'); ?> <?php the_category(', ') ?></span>
			</p>
		</header>
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
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else: ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>