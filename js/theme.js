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

//This is for the fittext.js plugin, modify it how you would like!
jQuery("#responsive_headline").fitText(1.2, { minFontSize: '20px', maxFontSize: '150px' })