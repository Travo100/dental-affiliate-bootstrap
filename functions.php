<?php 
// Requires
require_once dirname(__FILE__) . '/utilities.php'; // Utilities Functions
require_once dirname(__FILE__) . '/dynamic_content.php'; // Dynamic Content
require_once dirname(__FILE__) . '/tgm.php'; // Setup Required Plugins
require_once dirname(__FILE__) . '/enqueues.php'; // Enqueues
require_once dirname(__FILE__) . '/theme_support.php'; // Theme Support
require_once dirname(__FILE__) . '/nav.php'; // Menus/Nav
require_once dirname(__FILE__) . '/widgets.php'; // Custom Widgets
require_once dirname(__FILE__) . '/customizer.php'; // Theme Customization
require_once dirname(__FILE__) . '/shortcodes.php'; // Custom Shortcodes
require_once dirname(__FILE__) . '/theme_options.php'; // Custom Theme Options
require_once dirname(__FILE__) . '/gallery.php'; // Custom Gallery Lightbox
require_once dirname(__FILE__) . '/video-gallery.php'; // Video Gallery
require_once dirname(__FILE__) . '/pop-up-box.php'; // Pop Up Box

register_dyn_content( array(
  "home" => array (
    "title", 
    "slogan"
  ),
  "page1" => array (
  	"content",
  	"slogan"
  )
) );
/* get_dyn_content("home", "title"); ?>  The getter function */
?>
