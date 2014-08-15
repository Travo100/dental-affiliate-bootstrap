<?php

/*
  Template Name: Video Gallery Template
  Desciption: This template allows the content to span to full width of the page within a col-md-12 class. 
 */

?>
<?php get_header(); ?>

<div id="large-video">
  <div id="target">
    <a href="" id="facebook-share" class="video-share"><img src="<?php ilink('facebook.jpg'); ?>" /></a>
    <a href="" id="twitter-share" class="video-share"><img src="<?php ilink('twitter.jpg'); ?>" /></a>
    <div id="replacement"></div>
  </div>
</div>
<div class="thumbs">
<div id="scroll-left" class="scroll-control" data-scroll="-1"><i class="fa fa-arrow-circle-o-left"></i></div>
<div id="scroll-right" class="scroll-control" data-scroll="1"><i class="fa fa-arrow-circle-o-right"></i></div>
<div class="scroll-container">
<?php 
$i = 0;
foreach(get_vgallery_ids() as $id) {
  $i++;
  if (!(get_post_meta($id, 'vid', true) == '')) {
?>
<a class="thumb" href="#<?php echo $id; ?>">
<div class="preview" data-vid="<?php echo get_post_meta($id, 'vid', true); ?>" style="background-image: url(http://img.youtube.com/vi/<?php echo get_post_meta($id, 'vid', true); ?>/0.jpg);">
      <div class="overlay"></div>
      <p><span><?php echo get_post_meta($id, 'video_name', true); ?></span><i class="fa fa-play fa-3x"></i></p>
    </div>
  </a>
<?php
} }
?>
</div>
</div>
<?php get_footer(); ?>
