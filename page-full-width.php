<?php

/*
  Template Name: Full Width Template
  Desciption: This template allows the content to span to full width of the page within a col-md-12 class. 
*/

?>
<?php get_header(); ?>
    
<div class="container">
      
<div class="row">
  <div class="col-md-12"> <!-- make a 12 col area for the content -->
      <?php if (have_posts() ): while ( have_posts() ) : the_post(); ?> <!-- wordpress loop to display content -->
          
        <div class="page-header"> <!-- page-header is a bootstrap class -->
          <h1><?php the_title(); ?></h1> <!-- get the page title and display it as an h1 -->
        </div>

        <?php the_content() ?> <!-- get the content of the page -->

      <?php endwhile; else: ?>
          
        <div class="page-header">
          <h1>Oh no!</h1>
        </div>
        
        <p>No content is appering for this page!</p>
     
        <?php endif; ?>
  </div> <!-- end of col-md-12-->
          
</div>
    
<?php get_footer(); ?>

     
