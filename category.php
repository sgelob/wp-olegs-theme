<?php 
	
	/*
	@package Olegs
	*/
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
	<div class="about-content">
		<header>
			<h1 itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h1>
			<p><span itemprop="author" itemscope itemtype="https://schema.org/Person"><span itemprop="name"><?php $author = get_the_author(); echo $author; ?></span></span>
				<span class="sep">·</span>
				<time itemprop="datePublished" datetime="<?php the_date('c'); ?>"><?php the_time('d/m/Y'); ?></time>
				<meta itemprop="dateModified" content="<?php the_modified_date('c'); ?>"/>
				<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization"/>
					<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						<meta itemprop="url" content="<?php echo get_stylesheet_directory_uri(); ?>/img/olegs-belousovs-portrait.jpg">
						<meta itemprop="width" content="1200px">
						<meta itemprop="height" content="1200px">
    				</span>
					<meta itemprop="name" content="<?php $author = get_the_author(); echo $author; ?>">
				</span>
				<span class="sep">·</span>
				<span><?php _e('Articolo in', 'olegs'); ?> <?php the_category(', ') ?></span>
			</p>
		</header>
		<p class="excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
		<div class="clearfix"></div>
	</div>
	</article>

<?php endwhile; else : ?>
	<h3><?php _e('Sorry, no matched your criteria.', 'olegs'); ?></h3>
<?php endif; ?>
          
<?php get_footer(); ?>