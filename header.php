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
	<meta name="theme-color" content="#31659b"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="Accept-CH" content="DPR, Viewport-Width, Width">
	<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/manifest.json">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon-32x32.png" sizes="32x32" />
	<link rel="dns-prefetch" href="https://www.google-analytics.com">
	<link rel="dns-prefetch" href="https://code.jquery.com">
	<title><?php wp_title(''); ?></title>
	
	<script>
		/*! loadCSS: load a CSS file asynchronously. [c]2016 @scottjehl, Filament Group, Inc. Licensed MIT */
		!function(e){"use strict";var n=function(n,t,o){function i(e){return a.body?e():void setTimeout(function(){i(e)})}function r(){l.addEventListener&&l.removeEventListener("load",r),l.media=o||"all"}var d,a=e.document,l=a.createElement("link");if(t)d=t;else{var s=(a.body||a.getElementsByTagName("head")[0]).childNodes;d=s[s.length-1]}var f=a.styleSheets;l.rel="stylesheet",l.href=n,l.media="only x",i(function(){d.parentNode.insertBefore(l,t?d:d.nextSibling)});var u=function(e){for(var n=l.href,t=f.length;t--;)if(f[t].href===n)return e();setTimeout(function(){u(e)})};return l.addEventListener&&l.addEventListener("load",r),l.onloadcssdefined=u,u(r),l};"undefined"!=typeof exports?exports.loadCSS=n:e.loadCSS=n}("undefined"!=typeof global?global:this);
	
		loadCSS( "<?php bloginfo('template_directory'); ?>/style.css" );
	</script>
	
	<!-- No JS support -->
	<noscript>
		<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
	</noscript>
	
	<!-- Critical CSS includes -->
	<style>
	<?php
		if ( is_front_page() ) {
			include (TEMPLATEPATH . '/critical-home.css');
		} else if ( is_page_template( 'page-about.php' ) ) {
			include (TEMPLATEPATH . '/critical-about.css');
		} else if ( is_page_template( 'page-landing.php' ) ) {
			include (TEMPLATEPATH . '/critical-landing.css');
		} else if ( is_singular('galleries') ) {
			include (TEMPLATEPATH . '/critical-gallery.css');
		} else if ( is_page_template( 'page-blog.php' ) || is_single() || is_category() ) {
			include (TEMPLATEPATH . '/critical-blog.css');
		} else if ( is_page_template( 'page-photos.php' ) || is_tax() ) {
			include (TEMPLATEPATH . '/critical-photos.css');
		}
	?>
	
	/* 	lazysizes */
	.no-js .lazyload{display:none}.lazyload{opacity:0}.lazyloading{opacity:1;transition:600ms opacity;background:url(<?php bloginfo('url'); ?>/wp-content/plugins/wp-lazysizes/img/loader.gif)center no-repeat #f7f7f7;min-height:35px;min-width:35px}.lazyloaded{opacity:1;transition:9ms opacity;background:0 0}.intrinsic-ratio-box{position:relative;display:block;width:100%}.intrinsic-ratio-helper{display:block;height:0;width:100%;padding-bottom:56.25%}.intrinsic-ratio-box .intrinsic-ratio-element,.intrinsic-ratio-box iframe,.intrinsic-ratio-box img,.intrinsic-ratio-box object,.intrinsic-ratio-box video{position:absolute;top:0;left:0;width:100%;height:100%}[data-expand].lazyload.intrinsic-ratio-box{opacity:0;-webkit-transform:scale(1.05)translateY(-10%);transform:scale(1.05)translateY(-10%);transition:all 300ms}[data-expand].lazyloaded.intrinsic-ratio-box{opacity:1;transition:all 300ms;transform:scale(1)translateY(0)}
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