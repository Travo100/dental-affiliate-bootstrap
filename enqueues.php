<?php
function theme_styles() {
  wp_enqueue_style( 'google-fonts','http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Great+Vibes|Tangerine' );
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
  wp_enqueue_style( 'boostrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
  wp_enqueue_style( 'blueimp', 'http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css' );
  wp_enqueue_style( 'image-gallery', get_template_directory_uri() . '/css/bootstrap-image-gallery.min.css'); 
  wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
  //wp_enqueue_style( 'updates_css', get_template_directory_uri() . '/updates.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_js() {

  global $wp_scripts;

  wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );  
  wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );  

  $wp_scripts->add_data( 'html_shiv', 'conditional', 'lt IE 9' );
  $wp_scripts->add_data( 'respond_js', 'conditional', 'le IE 9' );


  wp_enqueue_script( 'blue_imp', 'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js', '', '', true );
  wp_enqueue_script ( 'retina_js', get_template_directory_uri() . '/js/retina.js', '', '', true );
  wp_enqueue_script ( 'fixtext_js', get_template_directory_uri() . '/js/jquery.fittext.js', '', '', true );
  wp_enqueue_script( 'theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery', 'bootstrap_js'), '', true );
  wp_enqueue_script( 'blue_imp_js', get_template_directory_uri() . '/js/bootstrap-image-gallery.min.js', array('jquery'), '',true);
  wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
  

}	
add_action( 'wp_enqueue_scripts', 'theme_js' );
?>
