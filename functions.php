<?php
/**
 * Masters-Ribakoff functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Masters-Ribakoff
 */

if ( ! function_exists( 'masters_ribakoff_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function masters_ribakoff_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Masters-Ribakoff, use a find and replace
	 * to change 'masters-ribakoff' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'masters-ribakoff', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'masters-ribakoff' ),
		'footer' => esc_html__( 'Footer Menu', 'masters-ribakoff' ),
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
	add_theme_support( 'custom-background', apply_filters( 'masters_ribakoff_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	//add excerpt support to pages
	 add_post_type_support( 'page', 'excerpt' );
}
endif; // masters_ribakoff_setup
add_action( 'after_setup_theme', 'masters_ribakoff_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function masters_ribakoff_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'masters_ribakoff_content_width', 640 );
}
add_action( 'after_setup_theme', 'masters_ribakoff_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function masters_ribakoff_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'masters-ribakoff' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'masters_ribakoff_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function masters_ribakoff_scripts() {
	wp_enqueue_style( 'masters-ribakoff-style', get_stylesheet_uri() );

	wp_enqueue_script( 'masters-ribakoff-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'masters-ribakoff-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'masters_ribakoff_scripts' );

/**
 * Change excerpts length and more for pages
 */
function page_excerpt_length( $length ) {
	return 46;
}
add_filter( 'excerpt_length', 'page_excerpt_length', 999 );

function page_excerpt_more( $more ) {
	//return '...';
	return '... <a href="'. get_permalink( get_the_ID() ) . '" >'. __('read more') . '</a>';
}
add_filter( 'excerpt_more', 'page_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
