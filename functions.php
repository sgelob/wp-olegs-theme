<?php

// jQuery
function my_jquery_enqueue()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.0.0.min.js', false, null, true);
    
    if (is_singular('galleries') || is_single()) {
    	wp_enqueue_script('jquery');
    }
}

add_action('wp_enqueue_scripts', 'my_jquery_enqueue');

// General Scripts
function olegs_register_files() {
    wp_register_script(
        'custom-scripts',
        get_stylesheet_directory_uri().'/build/js/scripts.js',
        array('jquery'),
        0.1,
        true
    );
    if (is_singular('galleries') || is_single()) {
        wp_enqueue_script('custom-scripts');
    }
}

add_action('wp_enqueue_scripts', 'olegs_register_files');

// Remove WordPress version meta tag

remove_action('wp_head', 'wp_generator');

// Disable Emoji

function disable_wp_emojicons()
{
    // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
}
add_action('init', 'disable_wp_emojicons');

// Remove Windows Live Writer link in header
// Do Not do this if you use it
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Remove WP version info
function hide_wp_vers()
{
    return '';
} // end hide_wp_vers function

add_filter('the_generator', 'hide_wp_vers');

// Remove Jetpack’s Open Graph meta tags
add_filter('jetpack_enable_open_graph', '__return_false', 99);

// Remove Carousel’s stylesheet

function changejp_dequeue_styles()
{
    wp_dequeue_style('jetpack-carousel');
}
add_action('post_gallery', 'changejp_dequeue_styles', 1001);

// Define a specific width for Tiled Gallery

if (!isset($content_width)) {
    $content_width = 1280;
}

// Dequeque devicepx from Jetpack
function dequeue_devicepx()
{
    wp_dequeue_script('devicepx');
}

add_action('wp_enqueue_scripts', 'dequeue_devicepx', 20);

// Don't add the wp-includes/js/comment-reply.js?ver=20090102 script to single post pages unless threaded comments are enabled
// adapted from http://bigredtin.com/behind-the-websites/including-wordpress-comment-reply-js/
function theme_queue_js()
{
    if (!is_admin()) {
        if (is_singular() && (get_option('thread_comments') == 1) && comments_open() && have_comments()) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('wp_print_scripts', 'theme_queue_js');

/* Thumbnails */

add_theme_support('post-thumbnails');

// add post-formats to post_type 'page'
add_post_type_support('post', 'post-formats');

/* THUMBNAIL SIZES */
add_image_size('square-320', 320, 320, true);
add_image_size('square-480', 480, 480, true);
add_image_size('square-768', 768, 768, true);
// add_image_size( 'square-1024', 1024, 1024, true);

// Disable Self Pingbacks

function disable_self_trackback(&$links)
{
    foreach ($links as $l => $link) {
        if (0 === strpos($link, get_option('home'))) {
            unset($links[$l]);
        }
    }
}

add_action('pre_ping', 'disable_self_trackback');

// WordPress _transient buildup

add_action('wp_scheduled_delete', 'delete_expired_db_transients');

function delete_expired_db_transients()
{
    global $wpdb, $_wp_using_ext_object_cache;

    if ($_wp_using_ext_object_cache) {
        return;
    }

    $time = isset($_SERVER['REQUEST_TIME']) ? (int) $_SERVER['REQUEST_TIME'] : time();
    $expired = $wpdb->get_col("SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < {$time};");

    foreach ($expired as $transient) {
        $key = str_replace('_transient_timeout_', '', $transient);
        delete_transient($key);
    }
}

// Unregister all default WP Widgets //

function unregister_default_wp_widgets()
{
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// Disable Comments on WordPress Media Attachments //

function filter_media_comment_status($open, $post_id)
{
    $post = get_post($post_id);
    if ($post->post_type == 'attachment') {
        return false;
    }

    return $open;
}
add_filter('comments_open', 'filter_media_comment_status', 10, 2);

//Custom Theme Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface()
{
    add_options_page('Global Custom Fields', 'Global Custom Fields', '8', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields()
{
    ?>
	<div class='wrap'>
	<h2>Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Footer Content First</strong><br />
	<textarea name="footercontent1" cols="100%" rows="7"><?php echo get_option('footercontent1');
    ?></textarea></p>
	
	<p><strong>Footer Content Second</strong><br />
	<textarea name="footercontent2" cols="100%" rows="7"><?php echo get_option('footercontent2');
    ?></textarea></p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="footercontent1, footercontent2" />

	</form>
	</div>
	<?php

}

// Registra il menu principale e secondario etc…
register_nav_menu('primary', 'Menu Principale');
register_nav_menu('footer-social', 'Menu Social Footer');

add_filter('nav_menu_item_id', '__return_false');
add_filter('nav_menu_item_class', '__return_false');

// 5. CUSTOM POSTS //

add_action('init', 'ideal_register_my_post_types');

function ideal_register_my_post_types()
{
    register_post_type('galleries',
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
        'not_found' => 'No galleries found',
        'not_found_in_trash' => 'No galleries found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Galleries',
    ),
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-gallery',
        // 'taxonomies' => array( 'category' ),
        'rewrite' => array('slug' => 'gallery'),
        'supports' => array('title', 'page-attributes', 'custom-fields', 'editor', 'excerpt', 'thumbnail', 'comments'),
        )
    );

    register_post_type('quotes',
        array(
            'labels' => array(
        'name' => 'Quotes',
        'singular_name' => 'Quote',
        'add_new' => 'Add New Quote',
        'add_new_item' => 'Add New Quote',
        'edit_item' => 'Edit Quote',
        'new_item' => 'New Quote',
        'all_items' => 'All Quotes',
        'view_item' => 'View Quote',
        'search_items' => 'Search Quotes',
        'not_found' => 'No quote found',
        'not_found_in_trash' => 'No quotes found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Quotes',
    ),
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-quote',
        'taxonomies' => array('quote-author'),
        'rewrite' => array('slug' => 'quote'),
        'supports' => array('title', 'editor'),
        )
    );

    register_post_type('services',
        array(
            'labels' => array(
        'name' => 'Services',
        'singular_name' => 'Service',
        'add_new' => 'Add New Service',
        'add_new_item' => 'Add New Service',
        'edit_item' => 'Edit Service',
        'new_item' => 'New Service',
        'all_items' => 'All Services',
        'view_item' => 'View Service',
        'search_items' => 'Search Services',
        'not_found' => 'No services found',
        'not_found_in_trash' => 'No services found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Services',
    ),
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-list-view',
        // 'taxonomies' => array( 'category' ),
        'rewrite' => array('slug' => 'service'),
        'supports' => array('title', 'page-attributes', 'editor', 'custom-fields'),
        )
    );
}

// 9. CUSTOM TAXONOMIES //

add_action('init', 'register_my_taxonomies', 0);

function register_my_taxonomies()
{
    register_taxonomy('genre',
        array('galleries'),
        array(
            'labels' => array(
                'name' => __('Photography Genre'),
                'singular_name' => __('Genre'),
            ),
            'public' => true,
            'show_ui' => true,
            'hierarchical' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'photos/genre'),
        )
    );
    register_taxonomy('country',
        array('galleries'),
        array(
            'labels' => array(
                'name' => __('Countries'),
                'singular_name' => __('Country'),
            ),
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'photos/country'),
        )
    );
    register_taxonomy('quote-author',
        array('quotes'),
        array(
            'labels' => array(
                'name' => __('Quote Authors'),
                'singular_name' => __('Quote Author'),
            ),
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'quote-author'),
        )
    );
}

// Add Excerpts to Your Pages in WordPress

add_action('init', 'my_add_excerpts_to_pages');

function my_add_excerpts_to_pages()
{
    add_post_type_support('page', 'excerpt');
}

// Thumbnails anteprima nelle liste dei post e pagine

if (!function_exists('fb_AddThumbColumn') && function_exists('add_theme_support')) {

    // for post and page

    function fb_AddThumbColumn($cols)
    {
        $cols['thumbnail'] = __('Thumbnail');

        return $cols;
    }

    function fb_AddThumbValue($column_name, $post_id)
    {
        $width = (int) 35;
        $height = (int) 35;

        if ('thumbnail' == $column_name) {
            // thumbnail of WP 2.9
                $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                // image from gallery
                $attachments = get_children(array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
            if ($thumbnail_id) {
                $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
            } elseif ($attachments) {
                foreach ($attachments as $attachment_id => $attachment) {
                    $thumb = wp_get_attachment_image($attachment_id, array($width, $height), true);
                }
            }
            if (isset($thumb) && $thumb) {
                echo $thumb;
            } else {
                echo __('None');
            }
        }
    }

    // for posts
    add_filter('manage_posts_columns', 'fb_AddThumbColumn');
    add_action('manage_posts_custom_column', 'fb_AddThumbValue', 10, 2);

    // for pages
    add_filter('manage_pages_columns', 'fb_AddThumbColumn');
    add_action('manage_pages_custom_column', 'fb_AddThumbValue', 10, 2);
}

// Apply class to every paragraph that holds image

add_filter('the_content', 'img_p_class_content_filter', 20);

function img_p_class_content_filter($content)
{
    $content = preg_replace("/(<p[^>]*)(\>.*)(\<img.*)(<\/p>)/im", "\$1 class='img-wrap'\$2\$3\$4", $content);

    return $content;
}

// Add itemprop="url" to Social links list in About

class My_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"about-get-in-touch\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $output .= '<li>';
        $attributes = ' itemprop="url" target="_blank" class="u-url" href="'.esc_attr($item->url).'"';
        $item_output = $args->before;
        $current_url = (is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $item_url = esc_attr($item->url);
        $item_output .= '<a'.$attributes.' role="button">'.$item->title.'</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
    }
}

// Remove some WordPress SEO columns in Posts list

add_filter('wpseo_use_page_analysis', '__return_false');

// Dynamic content years range

function olegs_copyright()
{
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
    $output = '';
    if ($copyright_dates) {
        $copyright = $copyright_dates[0]->firstdate;
        if ($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= '-'.$copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }

    return $output;
}

// AMP

add_action( 'init', 'xyz_amp_add_cpt', 9 ); // before amp_init

function xyz_amp_add_cpt() {
    if ( ! defined( 'AMP_QUERY_VAR' ) ) {
        return; // amp probably not installed...
    }
    add_post_type_support( 'galleries', 'AMP_QUERY_VAR' );
}

add_action( 'pre_amp_render_post', 'xyz_amp_add_custom_actions' );
function xyz_amp_add_custom_actions() {
    add_filter( 'the_content', 'xyz_amp_add_excerpt' );
}
function xyz_amp_add_excerpt( $content ) {
    $postdescription = sprintf( '<p class="amp-wp-excerpt"><strong>%s</strong></p>', get_the_excerpt() );
    $content = $postdescription . $content;
	return $content;
}

// Removing Jetpack CSS

// First, make sure Jetpack doesn't concatenate all its CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

// Then, remove each CSS file, one at a time
function jeherve_remove_all_jp_css() {
  wp_deregister_style( 'AtD_style' ); // After the Deadline
  wp_deregister_style( 'jetpack_likes' ); // Likes
  wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
  wp_deregister_style( 'jetpack-carousel' ); // Carousel
  wp_deregister_style( 'grunion.css' ); // Grunion contact form
  wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
  wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
  wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
  wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
  wp_deregister_style( 'noticons' ); // Notes
  wp_deregister_style( 'post-by-email' ); // Post by Email
  wp_deregister_style( 'publicize' ); // Publicize
  wp_deregister_style( 'sharedaddy' ); // Sharedaddy
  wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
  wp_deregister_style( 'stats_reports_css' ); // Stats
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
  wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
  wp_deregister_style( 'presentations' ); // Presentation shortcode
  wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
  wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
  wp_deregister_style( 'widget-conditions' ); // Widget Visibility
  wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
  wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
  wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'jeherve_remove_all_jp_css' );

?>