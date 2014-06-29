<?php 
	
	function theme_styles() {
		wp_enqueue_style( 'google-fonts','http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Oxygen:400,700' );
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'boostrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'blueimp', 'http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css');
		wp_enqueue_style( 'image-gallery', get_template_directory_uri() . '/css/bootstrap-image-gallery.min.css'); 
		wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
		
    }
add_action( 'wp_enqueue_scripts', 'theme_styles' );
	
	function theme_js() {
		
		global $wp_scripts;

		wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );  
		wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );  
	
		$wp_scripts->add_data( 'html_shiv', 'conditional', 'lt IE 9' );
		$wp_scripts->add_data( 'respond_js', 'conditional', 'le IE 9' );
		// wp_enqueue_script( 'jquery-lib', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', '', '', true );
		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'blue_imp', 'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js', '', '', true );
		wp_enqueue_script( 'theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery', 'bootstrap_js'), '', true );
		wp_enqueue_script( 'blue_imp_js', get_template_directory_uri() . '/js/bootstrap-image-gallery.min.js', array('jquery'), '',true);
	
	}	
add_action( 'wp_enqueue_scripts', 'theme_js' );

// add_filter( 'show_admin_bar', '__return_false' ); //to turn off the admin bar

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

$defaults = array(
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

$args = array(
	'flex-width'    => true,
	'width'         => 1900,
	'flex-height'    => true,
	'height'        => 500,
	'default-image' => get_template_directory_uri() . '/images/header.jpg'
);
add_theme_support( 'custom-header', $args );



function register_theme_menus() {

	register_nav_menus(
		array(
			'header_menu' => __( 'Header Menu' ),
			'footer_menu' => __( 'Footer Menu' )
		)
	);
}
add_action( 'init', 'register_theme_menus' );


function create_widget($name, $id, $description) {

	register_sidebar(array(
		'name' => __($name),
		'id' => $id,
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

create_widget( 'Front Page Left', 'front-left', 'Displays on the left of the homepage');
create_widget( 'Front Page Center', 'front-center', 'Displays on the center of the homepage');
create_widget( 'Front Page Right', 'front-right', 'Displays on the right of the homepage');

create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar');
create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of blogs with a sidebar');
create_widget ( '404 Error Page', 'fourohfour', 'Displays on the 404 page');

?>