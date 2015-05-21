<?php
/**
 * Dream Big and Make Things Theme 1.0 functions and definitions
 *
 * @package Dream Big and Make Things Theme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'dbamt_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dbamt_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Dream Big and Make Things Theme 1.0, use a find and replace
	 * to change 'dbamt' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'dbamt', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	//change the defined size of the large image size to match layout width
	update_option( 'large_size_w', 700 );
	update_option( 'large_size_h', 700 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dbamt' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dbamt_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // dbamt_setup
add_action( 'after_setup_theme', 'dbamt_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function dbamt_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'dbamt' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'dbamt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dbamt_scripts() {
	wp_enqueue_style( 'dbamt-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:700,700italic,400,400italic' );

	wp_enqueue_style( 'dbamt-style', get_stylesheet_uri() );

	// wp_enqueue_script( 'modernizr-development', get_template_directory_uri() . '/js/modernizr-development.js' );
	wp_enqueue_script( 'modernizr-production', get_template_directory_uri() . '/js/modernizr-production.js' );

	wp_enqueue_script( 'dbamt-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'dbamt-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'dbamt-rythm-correct', get_template_directory_uri() . '/js/rythm-correct.js', array( 'jquery' ), true );

	wp_enqueue_script( 'dbamt-style-tweaks', get_template_directory_uri() . '/js/style-tweaks.js', array( 'jquery' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dbamt_scripts' );

/**
 * Add a read more link to the post excerpt.
 */
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

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
