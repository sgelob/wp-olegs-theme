<!DOCTYPE HTML> 
<html <?php
	if ( is_page_template( 'page-photos.php' ) || is_singular( 'galleries' ) || is_page( 9, 11, 634, 743 ) ) {
		echo 'lang="en-US"';
	} else {
		echo 'lang="it-IT"';
} ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon-32x32.png" sizes="32x32" />
	<title><?php wp_title(''); ?></title>
	

<script>
	// load CSS async
	function loadCSS(e,t,n){"use strict";function o(){var t;for(var i=0;i<s.length;i++){if(s[i].href&&s[i].href.indexOf(e)>-1){t=true}}if(t){r.media=n||"all"}else{setTimeout(o)}}var r=window.document.createElement("link");var i=t||window.document.getElementsByTagName("script")[0];var s=window.document.styleSheets;r.rel="stylesheet";r.href=e;r.media="only x";i.parentNode.insertBefore(r,i);o();return r}

	loadCSS( "<?php bloginfo('template_directory'); ?>/style.css" );
</script>

<!-- no js support -->
<noscript>
	<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
</noscript>

<!-- Critical CSS includes -->
<style>
<?php
	if(is_front_page()){
		include (TEMPLATEPATH . '/critical-home.css' );
	}else if ( is_singular('galleries') ){
		include (TEMPLATEPATH . '/critical-gallery.css' );
	}else if ( is_page_template( 'page-blog.php' ) || is_single() ){
		include (TEMPLATEPATH . '/critical-blog.css' );
	}else if ( is_page_template( 'page-photos.php' ) ){
		include (TEMPLATEPATH . '/critical-photos.css' );
	}
?>
</style>
	

<?php wp_head(); ?>
</head> 

<body <?php body_class(); ?>>
	<header <?php $headercolor = get_post_meta($post->ID, 'dark_header', true); if( ! empty( $headercolor ) ) { echo 'class="dark-header"'; } ?> role="banner">
		<div class="header-inner">
			<div>
				<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			</div>
			<nav role="navigation">
				<header>
					<h1 class="offscreen"><?php _e('Navigation menu', 'olegs'); ?></h1>
      			</header>
				<?php wp_nav_menu( array( 
					'theme_location' => 'primary',
					'container' => false,
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul>%3$s</ul>',
					'echo' => true,
					) );
				?>
			</nav>
		</div>
	</header>