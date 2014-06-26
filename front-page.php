    <?php get_header(); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?php echo header_image(); ?>); background-size: cover;">
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
     </div> 

    <div class="wrapper" style="width: 100%; border-top: 10px solid #000; border-bottom: 10px solid #000;">
      <div class="container">
      <?php
          $mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

          foreach( $mypages as $page ) {    
            $content = $page->post_content;
              if ( ! $content ) // Check for empty page
              continue;

          $content = apply_filters( 'the_content', $content );
        ?>
        <h2><?php echo $page->post_title; ?></a></h2>
        <div class="entry"><?php echo $content; ?></div>
    <?php
    } 
    ?> 

      </div>
    </div>
    <div class="wrapper" style="width: 100%; border-top: 10px solid red; border-bottom: 10px solid #000;">
        <div class="container">
        <?php
          $mypages = get_pages( array( 'child_of' => 2, 'sort_column' => 'post_date', 'sort_order' => 'ASC' ) );

          foreach( $mypages as $page ) {    
            $content = $page->post_content;
              if ( ! $content ) // Check for empty page
              continue;

          $content = apply_filters( 'the_content', $content );
        ?>
        <h2><?php echo $page->post_title; ?></a></h2>
        <div class="entry"><?php echo $content; ?></div>
    <?php
    } 
    ?> 
    </div>
    </div>    
      <?php get_footer(); ?>

     
