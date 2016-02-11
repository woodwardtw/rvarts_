<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */

add_image_size( 'front-page-thumb', 555, 312, true );


add_action('wp_enqueue_scripts', 'enqueue_month_view_scripts');
function enqueue_month_view_scripts() {
    if ( is_front_page() ) {
        Tribe__Events__Template_Factory::asset_package('ajax-calendar');
 Tribe__Events__Template_Factory::asset_package('events-css');
    }
}

function enqueue_social_view_scripts() {
    if ( is_page_template('social-page') ) {
        wp_register_script('codebird-js', ( get_bloginfo('stylesheet_url') . '/js/codebird-js.js'), true); //first register your custom script
		wp_enqueue_script('codebird-js'); 
    }
}

add_action( 'wp_enqueue_scripts', 'enqueue_social_view_scripts' );


function _tk_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_tk' ),
	) );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_tk_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _tk styles
	wp_enqueue_style( '_tk-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );

function getUsersByRole( $role ) {
	// find all users with given role
	// via http://sltaylor.co.uk/blog/get-wordpress-users-by-role/
	
	if ( class_exists( 'WP_User_Search' ) ) {
		$wp_user_search = new WP_User_Search( '', '', $role );
		$userIDs = $wp_user_search->get_results();
	} else {
		global $wpdb;
		$userIDs = $wpdb->get_col('
			SELECT ID
			FROM '.$wpdb->users.' INNER JOIN '.$wpdb->usermeta.'
			ON '.$wpdb->users.'.ID = '.$wpdb->usermeta.'.user_id
			WHERE '.$wpdb->usermeta.'.meta_key = \''.$wpdb->prefix.'capabilities\'
			AND '.$wpdb->usermeta.'.meta_value LIKE \'%"'.$role.'"%\'
		');
	}
	return $userIDs;
}

function midea_list_authors($user_role='author', $show_fullname = true) {
	// Generate a list of authors for a given role
	// default is to list authors and show full name
	
	global $wpdb;
	
	$blog_url = get_bloginfo('url'); // store base URL of blog
	$holding_pen = array(); // this is cheap, a holder for author data
 
 	echo '<ul>';
 	
	// get array of all author ids for a role
	$authors = getUsersByRole( $user_role );
		
	foreach ( $authors as $item ) {
	
		// get number of posts by this author; custom query
		$post_count = $wpdb->get_results("SELECT COUNT( * ) as cnt 
		FROM  $wpdb->posts
		WHERE  post_author =" . $item . "
		AND  post_type =  'tribe_events'
		AND  post_status =  'publish'");

		// only output authors with posts; ugly way to get to the result, but it works....
		
		if ($post_count[0]->cnt) {

			// load info on this user
			$author = get_userdata( $item);
						
			// store output in temp array; we use last names as an index in this array
			$holding_pen[$author->last_name] =  '<li><a href="' . $blog_url . '/author/'  . $author->user_login  . '"> ' . $author->display_name . ' (' . $post_count[0]->cnt . ')</a> </li>';
		}

	}
	
	// now sort the array on the index to get alpha order
	ksort($holding_pen);
	
	// now we can spit the output out.
	foreach ($holding_pen as $key=>$value) {
		echo $value;
	}
	echo '</ul>';
};


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';
