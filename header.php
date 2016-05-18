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
	<!-- Enable media queries for old IE -->
	<!--[if lt IE 9]>
		<script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
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