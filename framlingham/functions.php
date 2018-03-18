<?php
/**
 * Framlingham functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Framlingham
 */

if ( ! function_exists( 'framlingham_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function framlingham_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Framlingham, use a find and replace
	 * to change 'framlingham' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'framlingham', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Left', 'framlingham' ),
		'primary_right' => esc_html__( 'Primary Right', 'framlingham' ),
		'mobile' => esc_html__( 'Primary Mobile', 'framlingham' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.

}
endif;
add_action( 'after_setup_theme', 'framlingham_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function framlingham_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'framlingham_content_width', 1200 );
}
add_action( 'after_setup_theme', 'framlingham_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function framlingham_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'framlingham' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'framlingham' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="tm-article-title">',
		'after_title'   => '</h5>',
	) );

	
}
add_action( 'widgets_init', 'framlingham_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function framlingham_scripts() {

	wp_enqueue_style( 'framlingham-style', get_stylesheet_uri()  );
	wp_enqueue_style( 'app-css', get_stylesheet_directory_uri() . '/css/app.css' );
	wp_enqueue_style( 'shop-cart', get_stylesheet_directory_uri() . '/css/shop-cart.css' );
	wp_enqueue_style( 'flexslider-css', get_stylesheet_directory_uri() . '/css/flexslider.css' );
	wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/css/theme.css' );
	

	//wp_enqueue_script( 'froogaloop-js', get_template_directory_uri() . '/js/froogaloop.js', array(), '1.0', true );
	wp_enqueue_script( 'uikit-js', get_template_directory_uri() . '/js/uikit.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'slideshow-js', get_template_directory_uri() . '/js/components/slideshow.js', array(), '1.0', true );
	wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/js/components/lightbox.min.js', array(), '1.0', true );
	wp_enqueue_script( 'sticky-js', get_template_directory_uri() . '/js/components/sticky.min.js', array(), '1.0', true );
	wp_enqueue_script( 'wistia-js', get_template_directory_uri() . '/js/wistia.js', array(), '1.0', true );


	wp_enqueue_script( 'map-js', get_template_directory_uri() . '/js/map-marker.js', array(), '1.0', true );
	wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '1.0', true );
	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/theme.js', array(), '1.0', true );
	//wp_enqueue_script( 'fitvid-js', get_template_directory_uri() . '/js/jquery.fitvid.js', array(), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'framlingham_scripts' );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


/**
 *
 * Allow upload of SVG to WordPress
 *
 */

function allow_svgimg_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svgimg_types');

/**
 *
 * Custom Nav Walker to wrap wp_nav_menu sub-menus
 * Add custom HTML to links containing sub-menus
 *
 */
class Framlingham_Sublevel_Walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class='tm-sub-menu'><ul class='uk-list-space'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		$submenus = 0 == $depth || 1 == $depth ? get_posts( array( 'post_type' => 'nav_menu_item', 'numberposts' => 1, 'meta_query' => array( array( 'key' => '_menu_item_menu_item_parent', 'value' => $item->ID, 'fields' => 'ids' ) ) ) ) : false;
		$item_output .= ! empty( $submenus ) ? ( 0 == $depth ? '<i class="uk-icon-caret-down"></i>' : '' ) : '';

		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

function create_archives_menu_entry( $item_output = '', $item = '', $depth = '', $args = '' ) {
	global $post;

	if ( $item->type == 'custom' && $item->object == 'custom' && $item->attr_title == 'archives') {
	//We eliminate the title since we use it just for selecting the correct entry
	$item_output = str_replace('title="archives" ' , '', $item_output);
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$indent_sub = ( $depth ) ? str_repeat( "\t", $depth + 1 ) : '';
		$item_output .= "\r\n$indent<div class=\"tm-sub-menu\"><ul class=\"uk-list-space sub-menu\">\r\n";
		$item_output .= wp_get_archives( array( 'type' => 'monthly', 'format' => 'custom', 'before' => $indent_sub . '<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2407 fusion-dropdown-submenu">', 'after' => '</li>', 'echo' => 0 ) );
		$item_output .= $indent . "</ul></div>\r\n";
	}

	return $item_output;
}

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}

}



add_filter( 'walker_nav_menu_start_el', 'create_archives_menu_entry', 10, 4 );

/**
 *
 * Disable Gravity forms submit button for a form
 *
 */
add_filter( 'gform_submit_button_1', '__return_false' );


/**
 *
 * Add class to links generated by next_posts_link and previous_posts_link
 * @link https://css-tricks.com/snippets/wordpress/add-class-to-links-generated-by-next_posts_link-and-previous_posts_link/
 *
 */

add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');
 
function post_link_attributes($output) {
	$code = 'class="uk-button uk-button-secondary uk-text-center uk-width-1-1 uk-position-relative"';
	return str_replace('<a href=', '<a '.$code.' href=', $output);
}

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyBRkdu8wrMItyL86EZ1puWx4zrHqdH0PFc');
}

add_action('acf/init', 'my_acf_init');

function my_mce_buttons_2( $buttons ) {    
    /**
     * Add in a core button that's disabled by default
     */
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';

    return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

include 'inc/shortcodes.php';
include 'inc/woocommerce.php';


/**
 * Add Favicon.
 */

function add_favicon() {
   $favicon_url = get_stylesheet_directory_uri() . '/images/favicon.ico';
 echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
  
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');




add_action( 'admin_menu', 'wooninja_remove_items', 99, 0 );
function wooninja_remove_items() {
 
// menu names to remove
$remove = array( 'wc-settings','wc-status','wc-addons');
 
foreach ( $remove as $slug ) {
if ( ! current_user_can( 'update_core' ) ) {
remove_submenu_page( 'woocommerce', $slug );
}
}
}


