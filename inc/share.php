<section class="share">
	<header>
		<h3><?php _e('Share this article', 'olegs'); ?></h3>
	</header>
	<a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>" target="_blank"><?php _e('Share on Facebook', 'olegs'); ?></a>
	<a class="share-twitter" href="https://twitter.com/intent/tweet/?text=<?php echo urlencode(get_the_title($post->ID)); ?>&url=<?php echo urlencode(wp_get_shortlink($post->ID)); ?>&via=sgelob&hashtags=photography,<?php $terms_as_text = get_the_term_list( $post->ID, 'genre', '', ', ', '' ); echo strip_tags(preg_replace('/\s+/', '', $terms_as_text)); ?>" target="_blank"><?php _e('Share on Twitter', 'olegs'); ?></a>
	<a class="share-google" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink($post->ID)); ?>" target="_blank"><?php _e('Share on Google+', 'olegs'); ?></a>
</section>