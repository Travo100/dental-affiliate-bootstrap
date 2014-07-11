
	
      <footer>
       
        <div class="col-md-6" style="margin:0; padding:0;">
        <p>&copy; <?php bloginfo('name') ;?> <?php echo date( 'Y' )?> | Powered By <a href="">Dental Affiliate</a></p>
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
      </footer>
    
	 <!-- modal for off-screen contact form -->
	 <div class="modal fade" id="contactForm">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Contact Us</h4>
	      </div>
	      <div class="modal-body">
	        <?php
	        	if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 1 ); }
	        ?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  
  <?php wp_footer(); ?>
  </body>
</html>
