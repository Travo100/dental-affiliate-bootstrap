<?php
/* ***** ADD MENU PAGE **** */
function dyn_content_menu() {
  add_menu_page( 'Dynamic Content Management', 'Content', 'administrator', basename( __FILE__ ), 'dyn_content_page' );
}
add_action('admin_menu', 'dyn_content_menu');

/* ***** ADD MENU PAGE **** */
function dyn_content_page() {
  global $options;
  if (isset($_POST['saved'])) {
    foreach($options as $gname => $group) {
      foreach($group as $item) {
        update_option(str_replace(' ', '_', $gname.'__'.$item), stripslashes($_POST[str_replace(' ', '_', $gname.'__'.$item)]));
      }
    }
    echo '<script>(function(){window.location.search = "?page=dynamic_content.php";})();</script>';
  } else {
    echo '
      <style>
        .group {  border: 1px solid #444; width: 75%; float: left; margin: 25px auto; background-color: white; }
        .group h2 { background-color: #eee; cursor: pointer; padding-left: 15px; font-size: 40px; margin: 0; line-height: 2em; }
        .group:after { content: " "; display: block; clear: both; }
        .content-cell { border-top: 1px solid #888; display: none; }
        .content-cell:after { content: " "; display: block; clear: both; }
        .content-cell h3 { font-size: 18px; background-color: #B4CBE3; margin: 0; line-height: 2em; text-align: center; }
        .content-cell .toggle { float: left; }
        .content-cell textarea { padding: 6px; font-size: 14px; outline: none !important; border: none !important; margin: 0; border-top: 1px dashed #888 !important; display: block; width: 100%; min-height: 120px; }
        input[type="submit"] { display: block; width: 75%; }
  </style><script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script><script>tinymce.init({selector:"textarea"});</script>';
    echo '<script>jQuery(document).ready(function() { jQuery(".group h2").click(function() { jQuery(this).find("~.content-cell").slideToggle(); }); });</script>';
    echo "<form method='post' id='dyn-content-form'>";
    echo "<div id='dyn-content-wrapper'>";
    echo "<input type='submit' value='Save'>";
    foreach($options as $gname => $group) {
      echo "<div class='group' id='$gname'>";
      echo "<h2>$gname</h2>";
        foreach($group as $item) {
          $current_item = get_option(str_replace(' ', '_', $gname.'__'.$item));
          echo "<div class='content-cell'>";
          echo "<div class='title'><h3>$item</h3></div>";
          echo "<div class='toggleable'>";
          echo "<textarea name='".$gname."__".$item."'>$current_item</textarea>";
          echo "</div>";
          echo "</div>";
        }
      echo "</div>";
    }
    echo "</div>";
    echo "<input type='hidden' name='saved'>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";
  }
}

/* ***** MENU PAGE CSS/JS ***** */
function dyn_content_page_css_js() {
  wp_enqueue_style('dyn_content_css', 'https://gist.githubusercontent.com/Mattykins/edf77fc7e1221e0313fd/raw/a07ea5ffbfd1985661a87a2a2a45addd29160e6b/admin.css'); //TODO: Move to local file
}
add_action('admin_enqueue_scripts', 'dyn_content_page_css_js');

/* ***** HELPER FUNCTION TO GENERATE CONTENT PANEL **** */
function register_dyn_content($content) {
  global $options;
  $options = $content;
}

/* ***** HELPER FUNCTION TO GET DYNAMIC CONTENT  **** */
function get_dyn_content($gname, $id) {
  echo stripslashes(get_option(str_replace(' ', '_', $gname.'__'.$id)));
}
?>
