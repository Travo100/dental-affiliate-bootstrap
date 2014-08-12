<?php
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

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
?>
