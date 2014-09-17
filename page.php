<?php get_header(); ?>

<div class="container">

  <div class="row row-offcanvas row-offcanvas-right">
    
    <div class="col-md-9"> <!-- make a 9 col area for the content -->
    
    <?php if (have_posts() ): while ( have_posts() ) : the_post(); ?> <!-- wordpress loop to display content -->
      
      <div class="page-header"> <!-- page-header is a bootstrap class -->
        <h1><?php the_title(); ?></h1> <!-- get the page title and display it as an h1 -->
      </div>

      <?php the_content() ?> <!-- get the content of the page -->
      <div style="clear:both;"></div>
      <hr>
      
      <?php comments_template(); ?>

    <?php endwhile; else: ?>
      
      <div class="page-header">
        <h1>Oh no!</h1>
      </div>
      <p>No content is appering for this page!</p>

    <?php endif; ?>
    </div> <!-- end of col-md-9 -->
      
      <?php get_sidebar(); ?>
    

  </div>
</div>

<?php get_footer(); ?>

     
