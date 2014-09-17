<footer>
 <div class="container">
  <div class="col-md-6" style="padding:0;">
    <p>&copy;<?php echo date( 'Y' ); ?> <?php bloginfo('name') ;?> &bull; Powered By <a href="http://dentalaffiliate.com" target="dental">Dental Affiliate&trade;</a>
  </div>
  <div class="col-md-6">
   <?php 
      $args = array( 
        'menu' => 'footer-menu',
        'menu_class' => 'footer-nav',
        'container' => 'false',
        'depth' => 1
        );
      wp_nav_menu( $args );
    ?>
   </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
