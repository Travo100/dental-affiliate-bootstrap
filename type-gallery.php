<?php
function register_gallery_post_type() {
  register_post_type('gallery', array(
    'public' => true,
    'labels' => array(
      'name' => __('Gallery'),
      'singular_name' => __('IMG')
    ),
    'supports' => array(
      'thumbnail',
      'title'
    )
  ));
}
add_action('init', 'register_gallery_post_type');
?>
