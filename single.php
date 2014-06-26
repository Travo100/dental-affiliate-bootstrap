    <?php get_header(); ?>
    
      <div class="container">
      
      <div class="row">
        <div class="col-md-9"> <!-- make a 9 col area for the content -->
        <?php if (have_posts() ): while ( have_posts() ) : the_post(); ?> <!-- wordpress loop to display content -->
          
          <div class="page-header"> <!-- page-header is a bootstrap class -->
            
            <?php 
                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
                $thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
              ?>
              <img src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo $thumbnail_meta; ?>">
              <h1><?php the_title(); ?></h1> <!-- get the page title and display it as an h1 -->
          </div>
          <p><em>
              By <?php the_author(); ?> 
              on <?php echo the_time( 'l, F jS, Y');?>
              in <?php the_category( ', ' );?> |
              <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
          </em><p> <!-- get the authors name and date of post -->


          <?php the_content() ?> <!-- get the content of the page -->
          
          <hr>

          <?php comments_template(); ?>

        <?php endwhile; else: ?>
          
          <div class="page-header">
            <h1>Oh no!</h1>
          </div>
          <p>No content is appering for this page!</p>
     
        <?php endif; ?>
        </div> <!-- end of col-md-9 -->
          
          <?php get_sidebar( 'blog' ); ?>
        
    
    </div>
    
    <?php get_footer(); ?>
     
