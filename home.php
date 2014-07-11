    <?php get_header(); ?>
    
      <div class="container">
      
      <div class="row">
        <div class="col-md-9"> <!-- make a 9 col area for the content -->
        
        <div class="page-header"> <!-- page-header is a bootstrap class -->
            <h1><?php wp_title(''); ?></h1> <!-- get the page title and display it as an h1 -->
        </div>
         
        <?php

          $args = array(
            'post_type' => 'post',
            'category_name' => 'featured'
          );
          $the_query = new WP_Query( $args );
        ?>
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php if (have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
              <li data-target="#carousel-example-generic" data-slide-to="<?php echo $the_query->current_post; ?>" class="<?php if ( $the_query->current_post == 0 ):?>active<?php endif; ?>"></li>
             <?php endwhile; endif; ?>
          </ol>
          
           <?php rewind_posts(); ?><!-- this rewinds the loop to the start -->

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            
            <?php if (have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="item <?php if ( $the_query->current_post == 0 ):?>active<?php endif; ?>">
              
              <?php 
                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
                $thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
              ?>
              <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo $thumbnail_meta; ?>"></a>
              <div class="carousel-caption"><?php the_title(); ?> </div>
            </div>
             <?php endwhile; endif; ?> 
          </div>
          
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>



        <?php if (have_posts() ): while ( have_posts() ) : the_post(); ?> <!-- wordpress loop to display content -->
          
          <article class="post"> 
            
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> <!-- get the title and display it as a link-->
           
              <p><em>
                By <?php the_author(); ?> 
                on <?php echo the_time( 'l, F jS, Y');?>
                in <?php the_category( ', ' );?> |
                <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
              </em></p> <!-- get the authors name and date of post -->
          
            <?php the_excerpt(); ?>
           <hr>
          </article>

         

        <?php endwhile; else: ?> <!-- end of user inputed page content -->
          
          <div class="page-header">
            <h1>Oh no!</h1>
          </div>
          <p>No content is appering for this page!</p>
     
        <?php endif; ?>
        </div> <!-- end of col-md-9 -->
          
          <?php get_sidebar( 'blog' ); ?>
        
    
    </div>
    
    <?php get_footer(); ?>

     
