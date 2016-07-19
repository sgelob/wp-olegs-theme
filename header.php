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
		} else if ( is_singular('galleries') ) {
			include (TEMPLATEPATH . '/critical-gallery.css');
		} else if ( is_page_template( 'page-blog.php' ) || is_single() ) {
			include (TEMPLATEPATH . '/critical-blog.css');
		} else if ( is_page_template( 'page-photos.php' ) ) {
			include (TEMPLATEPATH . '/critical-photos.css');
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