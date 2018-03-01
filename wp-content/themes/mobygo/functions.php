<?php
/**
 * mobyGo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mobyGo
 */

if ( ! function_exists( 'mobygo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mobygo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mobyGo, use a find and replace
		 * to change 'mobygo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mobygo', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'mobygo' ),
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
		add_theme_support( 'custom-background', apply_filters( 'mobygo_custom_background_args', array(
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
add_action( 'after_setup_theme', 'mobygo_setup' );



/* Add the logo code here */
function my_loginfooter() { 
    echo '<p style="text-align: center; margin-top: 1em;">
    <a style="color: #fff; text-decoration: none;" href="http://kreatika.mk/">Развиено од cedo najdeski.
        </a>
    </p>';
}
add_action('login_footer','my_loginfooter');




function custom_login_logo() {
	echo '<style type="text/css">
	body.login {background:#00ABC2;}
	h1 a { background-image: url(wp-content/themes/mobygo/img/mobly_logo.png) !important;width:320px!important;background-size:200px 70px!important; }
	body.login div#login form#loginform {background:#f3b911!important;}
	body.login div#login form#loginform p.submit input#wp-submit {background:banana!important;}
	body.login div#login p#nav a {color:#fff!important;}
	body.login div#login p#backtoblog a {color:#fff!important;}

	
	body.login div#login form#loginform p label {color:#fff!important;}
	</style>';
}
add_action('login_head', 'custom_login_logo');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mobygo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mobygo_content_width', 640 );
}
add_action( 'after_setup_theme', 'mobygo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mobygo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mobygo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mobygo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mobygo_widgets_init' );

/*Remove title*/

function change_the_title( $title) {
     if (is_page()) {
          $title = '';
      }
      return $title;
}
add_filter( 'the_title', 'change_the_title', 10);

/**
 * Enqueue scripts and styles.
 */
function mobygo_scripts() {
	wp_enqueue_style( 'mobygo-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mobygo-fa', 'https://use.fontawesome.com/releases/v5.0.7/js/all.js' );

	wp_enqueue_script( 'mobygo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mobygo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mobygo_scripts' );

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

