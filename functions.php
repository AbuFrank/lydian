<?php
/**
 * Lydian Center functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lydian_Center
 */

if ( ! function_exists( 'lydian_center_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lydian_center_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Lydian Center, use a find and replace
		 * to change 'lydian-center' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lydian-center', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'lydian-center' ),
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
		add_theme_support( 'custom-background', apply_filters( 'lydian_center_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'lydian_center_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lydian_center_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'lydian_center_content_width', 640 );
}
add_action( 'after_setup_theme', 'lydian_center_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lydian_center_widgets_init() {
	// default sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lydian-center' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lydian-center' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// front page testimonial widgets
	register_sidebar( array(
		'name' => __( 'Front Page Testimonials', 'lydian-center' ),
		'id' => 'front-testimonials',
		'before_widget' => '<div id="%1$s" class="widget %2$s col-lg-6">',
		'after_widget' => '</div>',
		// 'before_title' => '<h3 class="widgettitle">',
		// 'after_title' => '</h3>'
	));
}
add_action( 'widgets_init', 'lydian_center_widgets_init' );

function add_async_defer_attribute($tag, $handle) {
	if ( 'google_maps' !== $handle )
	return $tag;
	return str_replace( ' src', ' async defer src', $tag );
}
add_filter('script_loader_tag', 'add_async_defer_attribute', 10, 2);

// Variable to hold Google Maps API key
$google_maps_api = 'AIzaSyCEAb9qzch_rGEXwQTRWUiQCjqCzCZv22E';


/**
 * Enqueue scripts and styles.
 */
function lydian_center_scripts() {
	// default styling
	wp_enqueue_style( 'lydian-center-style', get_stylesheet_uri() );

	// local
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/boot/css/bootstrap.min.css', array(), true );

	wp_enqueue_style( 'fa-style', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), true );
	// Owl Carousel
	wp_enqueue_style( 'owl-style', get_stylesheet_directory_uri() . '/apps/Owl-Carousel/owl.carousel.min.css', array(), true );
	// default Owl Carousel e.g. nav buttons
	wp_enqueue_style( 'owl-theme-style', get_stylesheet_directory_uri() . '/apps/Owl-Carousel/owl.theme.default.min.css', array(), true );
	// custom styling
	wp_enqueue_style( 'creative-style', get_stylesheet_directory_uri() . '/style-creative.css' );
	// custom javascript
	wp_enqueue_script( 'creative-js', get_template_directory_uri() . '/js/creative.js', array( 'jquery' ), true );

	wp_enqueue_script( 'lydian-center-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'owl-js', get_stylesheet_directory_uri() . '/apps/Owl-Carousel/owl.carousel.min.js', array('jquery'), true );
	wp_enqueue_script( 'scroll-to-js', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), true );

	// local
	wp_enqueue_script( 'local-bootstrap-js', get_stylesheet_directory_uri() . '/boot/js/bootstrap.bundle.min.js', array(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lydian_center_scripts' );

/**
 * Split and span any string
 */
    function split_string_span($string) {
        $parts = explode(' ', $string);
        $output = false;
        $count = 0;

        foreach( $parts as $part ) {
            $count++;
            $output .= '<span class="part-'.$count.'">'.$part.'</span> ';
        }

        return $output;
    }
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * CB: Register Custom Navigation Walker
 */
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Custom post types function for testimonials
function create_custom_post_types(){
// Create testimonials post type
	register_post_type('testimonials',
		array(
		'labels' => array(
			'name' => __('Testimonials'),
			'singular_name' => __('Testimonial'),
			),
		'public' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'rewrite' => false,
		)
	);
	// Create services post type
	register_post_type('services',
		array(
		'labels' => array(
			'name' => __('Services'),
			'singular_name' => __('Service'),
			),
		'public' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'rewrite' => false,
		)
	);
	// Create practitioners post type
	register_post_type('practitioners',
		array(
		'labels' => array(
			'name' => __('Practitioners'),
			'singular_name' => __('Practioner'),
			),
		'public' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'rewrite' => false,
		)
	);
	// Create practitioners post type
	register_post_type('For Children',
		array(
		'labels' => array(
			'name' => __('For Children'),
			'singular_name' => __('Age Group'),
			),
		'public' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'rewrite' => false,
		)
	);
	// Create books post type
	register_post_type('books',
		array(
		'labels' => array(
			'name' => __('Books'),
			'singular_name' => __('Book'),
			),
		'public' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'rewrite' => false,
		)
	);
}

// Hook this custom post type function into the theme
add_action('init', 'create_custom_post_types');


 