<?php

// jQuery
function my_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://code.jquery.com/jquery-1.11.2.min.js', false, null);
	wp_enqueue_script('jquery');
}

add_action( 'wp_enqueue_scripts', 'my_jquery_enqueue' );

 function pbd_alp_init() {
 	global $wp_query;
 
 	// Add code to index pages.

 		// Queue JS
 		wp_enqueue_script(
 			'pbd-alp-load-posts',
 			get_template_directory_uri() . 'js/load-posts.js',
 			array('jquery'),
 			'1.0',
 			true
 		);
 		
 		// What page are we on? And what is the pages limit?
 		$max = $wp_query->max_num_pages;
 		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
 		
 		// Add some parameters for the JS.
 		wp_localize_script(
 			'pbd-alp-load-posts',
 			'pbd_alp',
 			array(
 				'startPage' => $paged,
 				'maxPages' => $max,
 				'nextLink' => next_posts($max, false)
 			)
 		);
 }
 add_action('after_setup_theme', 'pbd_alp_init');

//
	
remove_action('wp_head', 'wp_generator');

// Remove Emoji

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove Windows Live Writer link in header
// Do Not do this if you use it
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link'); 

// Remove WP version info
function hide_wp_vers()
{
    return '';
} // end hide_wp_vers function

add_filter('the_generator','hide_wp_vers');
	
// Remove Jetpack’s Open Graph meta tags
add_filter('jetpack_enable_open_graph', '__return_false', 99);

// Remove Carousel’s stylesheet

function changejp_dequeue_styles() {
    wp_dequeue_style( 'jetpack-carousel' );
}
add_action( 'post_gallery', 'changejp_dequeue_styles', 1001 );

// Define a specific width for Tiled Gallery

if ( ! isset( $content_width ) )
    $content_width = 1280;
    
// Dequeque devicepx from Jetpack
function dequeue_devicepx() {
	wp_dequeue_script( 'devicepx' );
}

add_action( 'wp_enqueue_scripts', 'dequeue_devicepx', 20 );


// Don't add the wp-includes/js/comment-reply.js?ver=20090102 script to single post pages unless threaded comments are enabled
// adapted from http://bigredtin.com/behind-the-websites/including-wordpress-comment-reply-js/
function theme_queue_js(){
  if (!is_admin()){
    if (is_singular() && (get_option('thread_comments') == 1) && comments_open() && have_comments())
      wp_enqueue_script('comment-reply');
  }
}
add_action('wp_print_scripts', 'theme_queue_js');

/* Thumbnails */
	
add_theme_support('post-thumbnails');

/* THUMBNAIL SIZES */
add_image_size( 'square-320', 320, 320, true);
add_image_size( 'square-480', 480, 480, true);
add_image_size( 'square-768', 768, 768, true);
// add_image_size( 'square-1024', 1024, 1024, true);

// Disable Self Pingbacks

function disable_self_trackback( &$links ) {
  foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}

add_action( 'pre_ping', 'disable_self_trackback' );

// WordPress _transient buildup

add_action( 'wp_scheduled_delete', 'delete_expired_db_transients' );

function delete_expired_db_transients() {

    global $wpdb, $_wp_using_ext_object_cache;

    if( $_wp_using_ext_object_cache )
        return;

    $time = isset ( $_SERVER['REQUEST_TIME'] ) ? (int)$_SERVER['REQUEST_TIME'] : time() ;
    $expired = $wpdb->get_col( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < {$time};" );

    foreach( $expired as $transient ) {

        $key = str_replace('_transient_timeout_', '', $transient);
        delete_transient($key);
    }
}

// Unregister all default WP Widgets //

function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// Disable Comments on WordPress Media Attachments //

function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

//Custom Theme Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Global Custom Fields', 'Global Custom Fields', '8', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
	?>
	<div class='wrap'>
	<h2>Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Footer Content First</strong><br />
	<textarea name="footercontent1" cols="100%" rows="7"><?php echo get_option('footercontent1'); ?></textarea></p>
	
	<p><strong>Footer Content Second</strong><br />
	<textarea name="footercontent2" cols="100%" rows="7"><?php echo get_option('footercontent2'); ?></textarea></p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="footercontent1, footercontent2" />

	</form>
	</div>
	<?php
}

// Registra il menu principale e secondario etc…
register_nav_menu( 'primary', 'Menu Principale' );
register_nav_menu( 'footer-social', 'Menu Social Footer' );

add_filter('nav_menu_item_id', '__return_false');
add_filter('nav_menu_item_class', '__return_false');


// 5. CUSTOM POSTS //

add_action( 'init', 'ideal_register_my_post_types' );

function ideal_register_my_post_types() {
	
	register_post_type( 'galleries',
		array(
			'labels' => array(
        'name' => 'Galleries',
        'singular_name' => 'Gallery',
        'add_new' => 'Add New Gallery',
        'add_new_item' => 'Add New Gallery',
        'edit_item' => 'Edit Gallery',
        'new_item' => 'New Gallery',
        'all_items' => 'All Galleries',
        'view_item' => 'View Gallery',
        'search_items' => 'Search Galleries',
        'not_found' =>  'No galleries found',
        'not_found_in_trash' => 'No galleries found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Galleries'
    ),
		'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-gallery',
        // 'taxonomies' => array( 'category' ),
        'rewrite' => array( 'slug' => 'gallery' ),
        'supports' => array( 'title', 'page-attributes', 'custom-fields', 'editor', 'excerpt', 'thumbnail', 'comments' )
		)
	);
}

// 9. CUSTOM TAXONOMIES //

add_action( 'init', 'register_my_taxonomies', 0 );

function register_my_taxonomies() {

	register_taxonomy('genre',
		array( 'galleries' ),
		array(
			'labels' => array(
				'name' => __( 'Photography Genre' ),
				'singular_name' => __( 'Genre' )
			),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'photos/genre' ),
		)
	);
	register_taxonomy('country',
		array( 'galleries' ),
		array(
			'labels' => array(
				'name' => __( 'Countries' ),
				'singular_name' => __( 'Country' )
			),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'photos/country' ),
		)
	);
}

// Add Excerpts to Your Pages in WordPress
	
add_action( 'init', 'my_add_excerpts_to_pages' );

function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
	
//* Thumbnails anteprima nelle liste dei post e pagine *//

if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
 
	// for post and page
 
	function fb_AddThumbColumn($cols) {
 
		$cols['thumbnail'] = __('Thumbnail');
 
		return $cols;
	}
 
	function fb_AddThumbValue($column_name, $post_id) {
 
			$width = (int) 35;
			$height = (int) 35;
 
			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				// image from gallery
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None');
					}
			}
	}
 
	// for posts
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
 
	// for pages
	add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}

// Apply class to every paragraph that holds image
add_filter( 'the_content', 'img_p_class_content_filter' ,20);

function img_p_class_content_filter($content) {
    $content = preg_replace("/(<p[^>]*)(\>.*)(\<img.*)(<\/p>)/im", "\$1 class='img-wrap'\$2\$3\$4", $content);
    return $content;
}

?>