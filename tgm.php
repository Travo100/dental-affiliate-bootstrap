<?php
require_once dirname(__FILE__) . '/includes/class-tgm-plugin-activation.php';

function register_recommended_theme_plugins() {
  $plugins = array(
    array(
      'name' => 'Gravity Forms',
      'slug' => 'gravity-forms',
      'source' => theme_link('/includes/plugins/gravityforms.zip')
    ),
    array(
      'name' => 'Wordpress Mover',
      'slug' => 'wp-mover',
      'source' => theme_link('/includes/plugins/mover.zip')
    ),
    array(
      'name' => 'WP Bootstrap Gallery',
      'slug' => 'wp-bootstrap-gallery',
      'source' => theme_link('/includes/plugins/wp-bootstrap-gallery.zip')
    ),
    array(
      'name' => 'ManageWP Worker',
      'slug' => 'managewp-worker',
      'source' => theme_link('/includes/plugins/worker.zip')
    ),
    array(
      'name' => 'Real Time Find and Replace',
      'slug' => 'real-time-find-and-replace',
      'source' => theme_link('/includes/plugins/real-time-find-and-replace.zip')
    )
  
  );

  tgmpa($plugins, array(

  ));
}
add_action('tgmpa_register', 'register_recommended_theme_plugins');
?>
