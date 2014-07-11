<?php
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

add_filter('widget_text', 'do_shortcode');
?>
