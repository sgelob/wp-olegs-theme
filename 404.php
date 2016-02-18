<?php 
	
	/*
	@package Olegs
	*/
	get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>

<div>
	<section class="gallery-cover">
		<header>
			<div>
				<h1>
					<span><strong><?php _e('Content not found', 'olegs'); ?></strong></span>
					<br>
					<span><?php _e('Sorry but I couldn\'t find the page you are looking for. Please check to make sure you\'ve typed the URL correctly.', 'olegs'); ?></span>
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