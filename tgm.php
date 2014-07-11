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
    )
  );

  tgmpa($plugins, array(

  ));
}
add_action('tgmpa_register', 'register_recommended_theme_plugins');
?>
