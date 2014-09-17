<?php
function theme_link($path) {
  return get_template_directory_uri() . $path;
}
function ilink($path) {
  echo theme_link('/images/' . $path);
} 
?>
