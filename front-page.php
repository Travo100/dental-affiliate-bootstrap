    <?php get_header(); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?php echo header_image(); ?>)">
      <!-- <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /> -->
      <div class="container">
        
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      
          <?php the_content(); ?>
      
      <?php endwhile; endif; ?>
      
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <?php if ( dynamic_sidebar ( 'front-left') ); ?>
        </div>
        <div class="col-md-4">
          <?php if ( dynamic_sidebar ( 'front-center') ); ?>
       </div>
        <div class="col-md-4">
           <?php if ( dynamic_sidebar ( 'front-right') ); ?>
        </div>
      </div>
      <?php get_footer(); ?>

     
