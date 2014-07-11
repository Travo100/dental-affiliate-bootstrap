<?php
//shortcode for posting blog catgories on a page use code [listposts num="number of post you want to show" cat="post categories"] or [listposts num="3" cat="1"]
function sc_listposts($atts, $content = null) {
  extract(shortcode_atts(array(
    "num" => '5',
    "cat" => ''
  ), $atts));
  global $post;
  $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
  $retour='<ul>';
  foreach($myposts as $post) :
    setup_postdata($post);
  $retour.= '<li class="image-post">' . '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($page->ID, array(70,70) ) . '</li>' . '</a>' .
    '<li>' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'. '<br />' . get_the_excerpt() . '<br />' . '<em>' . get_the_date() . '</em>' . '</li>';
endforeach;
$retour.='</ul> ';
return $retour;
}
add_shortcode("listposts", "sc_listposts");
?>
