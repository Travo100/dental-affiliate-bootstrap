    <?php get_header(); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url('<?php echo header_image(); ?>');">
      <div class="container">
        <p class="phone-number"><i class="fa fa-phone fa-2x" style=" vertical-align:middle;"></i><?php echo get_option('shortname_phone_url'); ?><p>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      
          <?php the_content(); ?>
      
      <?php endwhile; endif; ?>
        <!-- these are social media buttons for themes, you can hardcode them if -->
        <div class="social-icons">
          <a href="<?php echo get_option('shortname_facebook_url'); ?>"><i class="fa fa-facebook fa-3x"></i></a>
          <a href="<?php echo get_option('shortname_twitter_url'); ?>"><i class="fa fa-twitter fa-3x"></i></a>
          <a href="<?php echo get_option('shortname_linkedin_url'); ?>"><i class="fa fa-linkedin fa-3x"></i></a>
          <a href="<?php echo get_option('shortname_googleplus_url'); ?>"><i class="fa fa-google fa-3x"></i></a>
          <a href="<?php echo get_option('shortname_pinterest_url'); ?>"><i class="fa fa-pinterest fa-3x"></i></a>
          <a href="<?php echo get_option('shortname_youtube_url'); ?>"><i class="fa fa-youtube fa-3x"></i></a>
        </div>
      
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

  
      <?php
          $mypages = get_pages( array( 
            'child_of' => $post->ID, 
            'sort_column' => 
            'post_date', 
            'sort_order' => 'ASC', 
            'post_type' => 'page' ) 
          );

          foreach( $mypages as $page ) {    
            $content = $page->post_content;
              if ( ! $content ) // Check for empty page
              continue;

          $content = apply_filters( 'the_content', $content );
        ?>
      
      
      <div class="wrapper page-id-<?php echo $page->ID ?>"> 
      <div class="container">
        <h2><?php echo $page->post_title; ?></h2>

        <div class="entry"><?php echo $content; ?></div> <!-- end of .entry -->
        </div> <!-- end of .container -->
         </div> <!-- end of .wrapper -->
    <?php
    } 
    ?> 

      
    
      <div class="container">
      <?php get_footer(); ?>

     
