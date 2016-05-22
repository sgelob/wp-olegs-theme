<?php
	/*
	@package Olegs
	*/
get_header(); ?>
	<style>
		.gallery-cover {
			background-image: url( https://olegs.be/wp-content/uploads/2016/02/bugs-macro-photography-61-768x512.jpg );
		}
		
		@media all and (min-width: 768px) {
			.gallery-cover {
				background-image: url( https://olegs.be/wp-content/uploads/2016/02/bugs-macro-photography-61-1024x683.jpg );
			}
		}
		
		@media all and (min-width: 992px) {
			.gallery-cover {
				background-image: url( 'https://olegs.be/wp-content/uploads/2016/02/bugs-macro-photography-61.jpg' );
			}
		}
	</style>
	<article role="main">
		<header class="gallery-cover">
			<div>
				<h1 itemprop="headline"><?php _e('Content not found', 'olegs'); ?></h1>
				<p><?php _e('Sorry, but I couldn’t find the content you are looking for. Please, check to make sure you’ve typed the URL correctly.', 'olegs'); ?></p>
			</div>
		</header>
	</article>

<?php get_footer(); ?>