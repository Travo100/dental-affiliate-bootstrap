jQuery(document).ready(function ( $ ) {

//For the off screen sidebar to scroll
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active');
  });


//does not display social icons if the field is left blank
	$icons = $( '.social-icons a[href=]' );
	$mobileIcons = $( '.mobile-buttons a[href=]' );
	
	$icons.add($mobileIcons).css('display', 'none');
	
 
 });




