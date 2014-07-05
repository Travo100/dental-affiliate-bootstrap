jQuery(document).ready(function ( $ ) {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active');
  });


//does not display social icons if the field is left blank
var $icons = $( '.social-icons a[href=]' );
$icons.css('display', 'none');
 });




