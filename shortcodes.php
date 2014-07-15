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
             $retour.= '<li class="image-post">' . '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($page->ID, array(70,70) ) . '</li>' . '</a>' .
          '<li>' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'. '<br />' . excerpt(5) . '<br />' . '<em>' . get_the_date() . '</em>' . '</li>';
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

function content($limit) {
 $content = explode(' ', get_the_content(), $limit);
 if (count($content)>=$limit) {
 array_pop($content);
 $content = implode(" ",$content).'...';
 } else {
 $content = implode(" ",$content);
 }
 $content = preg_replace('/[.+]/','', $content);
 $content = apply_filters('the_content', $content);
 $content = str_replace(']]>', ']]&gt;', $content);
 return $content;
}
?>