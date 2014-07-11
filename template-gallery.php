<?php

/*
  Template Name: Smile Gallery
  Desciption: This template displays a smile gallery
*/

?>
<?php get_header(); ?>
    
<div class="container">
      
<div class="row">
  <div class="col-md-12"> <!-- make a 12 col area for the content -->
      <?php if (have_posts() ): while ( have_posts() ) : the_post(); ?> <!-- wordpress loop to display content -->
        <?php
        // Page Content Workaround
        ob_start();
        the_content();
        $page_content = ob_get_clean();
        ?>
        <div class="page-header"> <!-- page-header is a bootstrap class -->
          <h1><?php the_title(); ?></h1> <!-- get the page title and display it as an h1 -->
        </div>
            <!-- The container for the list of example images -->
    
        <div id="links">
          <?php
          $args = array(
            'post_type' => 'gallery'
          );
          $q = new WP_Query($args);
          if ($q->have_posts()) {
            while ($q->have_posts()) {
              $q->the_post();
              $src = wp_get_attachment_url(get_post_thumbnail_id(the_ID()));
          ?>
          <a href="<?php echo $src; ?>" data-gallery><img src="<?php echo $src; ?>" /></a>
          <?php
            }
          }
          ?>
        </div>
        <br />
        <div class="row">
          <div class="content col-md-12">
            <?php echo $page_content; ?>
          </div>
        </div>
    </div>
    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <!-- The container for the modal slides -->
        <div class="slides"></div>
        <!-- Controls for the borderless lightbox -->
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
        <!-- The modal dialog, which will be used to wrap the lightbox content -->
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body next"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left prev">
                            <i class="glyphicon glyphicon-chevron-left"></i>
                            Previous
                        </button>
                        <button type="button" class="btn btn-primary next">
                            Next
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    <?php endwhile; else: ?>
        
        <div class="page-header">
          <h1>Oh no!</h1>
        </div>
        
        <p>No content is appering for this page!</p>
     
        <?php endif; ?>
  </div> <!-- end of col-md-12-->
          
</div>
<div class="container">  
<?php get_footer(); ?>
