<?php
/**
 * my-simone functions and definitions
 *
 * @package my-simone
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'my_simone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_simone_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on my-simone, use a find and replace
	 * to change 'my-simone' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'my-simone', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'my-simone' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'my_simone_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // my_simone_setup
add_action( 'after_setup_theme', 'my_simone_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function my_simone_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'my-simone' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'my_simone_widgets_init' );

if ( function_exists('register_sidebars') ) {
	register_sidebar(array('name'=>'Sidebar 1',));
	register_sidebar(array('name'=>'Sidebar 2',));
	register_sidebar(array('name'=>'Sidebar 3',));
	register_sidebar(array('name'=>'Post Widget',));
}

/**
 * Enqueue scripts and styles.
 */
function my_simone_scripts() {
	wp_enqueue_style( 'my-simone-style', get_stylesheet_uri() );

	wp_enqueue_script( 'my-simone-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'my-simone-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_enqueue_scripts', 'mc_lightbox');

function mc_lightbox() {
	add_action( 'print_footer_scripts', 'my_footer_script' );
}

function my_footer_script() {
	if (!is_admin()): ?>
		<script type="text/javascript">
			function closeFB() {
			    jQuery.fancybox.close();
				location.href="http://transfermke.com";
			}
		</script>
	<?php endif;
 }
add_action( 'wp_enqueue_scripts', 'my_simone_scripts' );

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