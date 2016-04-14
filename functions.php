<?php
/**
 * owneon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package owneon
 */

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
	 * to change 'owneon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'owneon', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'owneon' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'owneon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'owneon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function owneon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'owneon_content_width', 640 );
}
add_action( 'after_setup_theme', 'owneon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function owneon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'owneon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'owneon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s foreground">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'owneon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function owneon_scripts() {
	wp_enqueue_style( 'owneon-style', get_stylesheet_uri() );

	wp_enqueue_script( 'owneon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'owneon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// custom scripts
        if ( is_singular('post') && has_post_thumbnail( get_the_ID() ) )
	{
                wp_enqueue_script( 'owneon-hide-foreground', get_stylesheet_directory_uri() . '/js/hide-foreground.js', array( 'jquery' ), '20140622', true );
	}
	if ( is_single() ) {
                wp_enqueue_script( 'owneon-headline', get_stylesheet_directory_uri() . '/js/headline.js', array( 'jquery' ), '20141110', true );
                wp_enqueue_script( 'owneon-main-menu', get_stylesheet_directory_uri() . '/js/main-menu.js', array( 'jquery' ), '20141801', true );
	}
	
	wp_enqueue_script( 'owneon-ajax', get_stylesheet_directory_uri() . '/js/ajax.js', array( 'jquery' ), '20161104', true );
}
add_action( 'wp_enqueue_scripts', 'owneon_scripts' );

/**
 * Further custom modifications
 */

 // functions to set class "foreground" at menu items and post content
function add_foreground_class( $classes, $item ) {
  $classes[] = 'foreground';
  return $classes;  
}
add_filter( 'nav_menu_css_class', 'add_foreground_class', 10, 2 );
add_filter( 'post_class', 'add_foreground_class', 10, 2 );

// function to set the query for taxonomy archives paged with n elements
// from https://codex.wordpress.org/Pagination
function tax_paged_query( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
  if ( !is_admin() && $query->is_main_query() && is_tax() ) {
      $query->set( 'posts_per_page', 8 );
  }
}
add_action( 'pre_get_posts', 'tax_paged_query' );

/**
 * Set featured image as background image, from:
 * @link http://stackoverflow.com/questions/23388561/set-featured-image-as-background-image-in-wordpress
 */
function featured_background_img()
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
                        }
                     </style>
                     <script type= "text/javascript">
			var img_height = %d;
			var img_width = %d;
		      </script>', 
                     $image, $height, $height, $width
            );
    } 
}
add_action( 'wp_head', 'featured_background_img' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

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
