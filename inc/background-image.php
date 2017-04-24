<?php // Get attachment image URLs
  $thumb_full = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
  $thumb_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
  $thumb_medium = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
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
  
   @media all and ((-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi)) {
    .gallery-cover {
      background-image: url( <?php echo $thumb_url_full; ?> );
    }
  }
</style>
