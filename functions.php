<?php
/**
 * owneon functions and definitions
 *
 * @package owneon
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'owneon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function owneon_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on owneon, use a find and replace
	 * to change 'owneon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'owneon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'owneon' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'owneon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // owneon_setup
add_action( 'after_setup_theme', 'owneon_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function owneon_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'owneon' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s foreground">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'owneon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function owneon_scripts() {
	wp_enqueue_style( 'owneon-style', get_stylesheet_uri() );

	wp_enqueue_script( 'owneon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'owneon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	if ( is_singular('post') && has_post_thumbnail( get_the_ID() ) )
	{
	  wp_enqueue_script( 'owneon-hide-foreground', get_stylesheet_directory_uri() . '/js/hide-foreground.js', array( 'jquery' ), '20140622', true );
	}
	if ( is_single() ) {
	  wp_enqueue_script( 'owneon-headline', get_stylesheet_directory_uri() . '/js/headline.js', array( 'jquery' ), '20141110', true );
	}
	wp_enqueue_script( 'owneon-main-menu', get_stylesheet_directory_uri() . '/js/main-menu.js', array( 'jquery' ), '20141801', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'owneon_scripts' );

// functions to set class "foreground" at menu items etc.
function add_foreground_class_nofront( $classes, $item ) {
  if( !is_front_page() ) {
    $classes[] = 'foreground';
  }
  return $classes;  
}
function add_foreground_class( $classes, $item ) {
  $classes[] = 'foreground';
  return $classes;  
}
add_filter( 'nav_menu_css_class', 'add_foreground_class', 10, 2 );
add_filter( 'post_class', 'add_foreground_class_nofront', 10, 2 );

// function to set the query for taxonomy archives paged with n elements
// from https://codex.wordpress.org/Pagination
function tax_paged_query( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
  if ( !is_admin() && $query->is_main_query() && is_tax() ) {
      $query->set( 'posts_per_page', 8 );
  }
}
add_action( 'pre_get_posts', 'tax_paged_query' );

// whats this?
function so_23388561_wp_head()
{
    if ( is_singular('post') && has_post_thumbnail( get_the_ID() ) )
    {
	    $id = get_post_thumbnail_id( get_the_ID() );
            $image = wp_get_attachment_url( $id, 'full' );
	    $height = wp_get_attachment_metadata( $id )["height"];
	    $width = wp_get_attachment_metadata( $id )["width"];
            printf( '<style>
                        #background { 
                            background: url("%s") black no-repeat center top scroll;
                            height: %dpx;
//                             width: %dpx;
                        }
                     </style>
                     <script type= "text/javascript">
			var img_height = %d;
			var img_width = %d;
		      </script>', 
                     $image, $height, $width, $height, $width
            );
    } 
}

add_action( 'wp_head', 'so_23388561_wp_head' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
