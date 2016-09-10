<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	$thumb_title = get_post(get_post_thumbnail_id())->post_title; //The Title
	$thumb_url = $thumb['0'];
?>

<article class="box">
	<a class="box-inner" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark" itemprop="relatedLink">
		<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<img data-srcset="<?php echo str_replace(".jpg", "-320x320.jpg", $thumb_url); ?> 320w,
			<?php echo str_replace(".jpg", "-480x480.jpg", $thumb_url); ?> 480w, <?php echo str_replace(".jpg", "-768x768.jpg", $thumb_url); ?> 768w" data-sizes="auto" data-optimumx="1.5" class="lazyload" src="<?php echo str_replace(".jpg", "-320x320.jpg", $thumb_url); ?>" alt="<?php echo $thumb_title; ?>" />
		<meta itemprop="url" content="<?php echo str_replace(".jpg", "-768x768.jpg", $thumb_url); ?>">
		</span>
		<h2 itemprop="headline"><?php $theshorttitle = get_post_meta($post->ID, 'home_short_title', true);
			if( ! empty( $theshorttitle ) ) {
				echo $theshorttitle;
			}
			else {
				the_title();
			}
			?></h2>
	</a>
</article>