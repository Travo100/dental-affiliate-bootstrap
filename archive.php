<?php get_header(); ?>

<div class="container">

  <div class="row">
    <div class="col-md-9"> <!-- make a 9 col area for the content -->
    
    <div class="page-header"> <!-- page-header is a bootstrap class -->
        <h1><?php wp_title(''); ?></h1> <!-- get the page title and display it as an h1 -->
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
</div>
    
    <?php get_footer(); ?>

     
