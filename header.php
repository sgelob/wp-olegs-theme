<!DOCTYPE HTML> 
<html <?php
	if ( is_page_template( 'page-blog.php' ) || is_singular( 'post' ) || is_page( 915 ) || is_category() ) {
		echo 'lang="it-IT"';
	} else {
		echo 'lang="en-US"';
} ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon-32x32.png" sizes="32x32" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php wp_title(''); ?></title>
	<!-- Enable media queries for old IE -->
	<!--[if lt IE 9]>
		<script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
<?php wp_head(); ?>
</head> 

<body <?php body_class(); ?>>
	<header <?php $headercolor = get_post_meta($post->ID, 'dark_header', true); if( ! empty( $headercolor ) ) { echo 'class="dark-header"'; } ?>>
		<div class="header-inner">
			<div>
				<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			</div>
			<nav>
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