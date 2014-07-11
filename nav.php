<?php
require_once('wp_bootstrap_navwalker.php');
function register_theme_menus() {

  register_nav_menus(
    array(
      'primary' => __( 'Primary Menu', 'dental-affiliate-bootstrap' ),
      'footer' => __( 'Footer Menu', 'dental-affiliate-bootstrap' )
    )
  );
}
add_action( 'init', 'register_theme_menus' );
?>
