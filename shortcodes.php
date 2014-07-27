<?php

//shortcode for posting blog catgories on a page use code [listposts num="number of post you want to show" cat="post categories"] or [listposts num="3" cat="1"]
function sc_listposts($atts, $content = null) {
        extract(shortcode_atts(array(
                "num" => '5',
                "cat" => ''
        ), $atts));
        global $post;
        $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
        $retour='<ul id="shortcode-ul">';
        foreach($myposts as $post) :
                setup_postdata($post);
             $retour.= '<div class="list-posts">' . '<li class="image-post">' . '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($page->ID, array(70,70) ) . '</li>' . '</a>' .
          '<li>' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'. '<br />' . excerpt(5) . '<br />' . '<em>' . get_the_date() . '</em>' . '</li>' . '</div>';
        endforeach;
        $retour.='</ul> ';
        return $retour;
}
add_shortcode("listposts", "sc_listposts");

function excerpt($limit) {
 $excerpt = explode(' ', get_the_excerpt(), $limit);
 if (count($excerpt)>=$limit) {
 array_pop($excerpt);
 $excerpt = implode(" ",$excerpt).'...';
 } else {
 $excerpt = implode(" ",$excerpt);
 }
 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
 return $excerpt;
}


/*
*shortcode for adding font-awesome icons anywhere in the theme, wordpress ignores <i> tags otherwise inside it's editor
* Basic use: [icon type="google-plus-square"] generates a google plus icon. 
* Read more: http://www.gregreindel.com/adding-font-awesome-icons-via-shortcode/
*/
function addscFontAwesome($atts) {
    extract(shortcode_atts(array(
    'type'  => '',
    'size' => '',
    'rotate' => '',
    'flip' => '',
    'pull' => '',
    'animated' => '',
    'class' => '',
  
    ), $atts));
 
    $classes  = ($type) ? 'fa-'.$type. '' : 'fa-star';
    $classes .= ($size) ? ' fa-'.$size.'' : '';
    $classes .= ($rotate) ? ' fa-rotate-'.$rotate.'' : '';
    $classes .= ($flip) ? ' fa-flip-'.$flip.'' : '';
    $classes .= ($pull) ? ' pull-'.$pull.'' : '';
    $classes .= ($animated) ? ' fa-spin' : '';
    $classes .= ($class) ? ' '.$class : '';
 
    $theAwesomeFont = '<i class="fa '.esc_html($classes).'"></i>';
      
    return $theAwesomeFont;
}
  
add_shortcode('icon', 'addscFontAwesome');



?>