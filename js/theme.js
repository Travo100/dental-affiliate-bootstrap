jQuery(document).ready(function ( $ ) {

  //For the off screen sidebar to scroll
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active');
  });


  //does not display social icons if the field is left blank
  $icons = $( '.social-icons a[href=]' );
  $mobileIcons = $( '.mobile-buttons a[href=]' );

  $icons.add($mobileIcons).css('display', 'none');

  function adjustVideoHeight() {
    $('#target, #large-video').height($('#target').width() * (9/16));
  }
  $(document).ready(adjustVideoHeight);
  $(window).resize(adjustVideoHeight);
  function initGallery() {
    var vid = $('.thumb').first().find('.preview').attr('data-vid');

    var player = new YT.Player('replacement', {
      height: $('#target').height(),
        width: $('#target').width(),
        videoId: vid,
        playerVars: {rel: 0}
    });

    function adjustSocialShares(vid) {
      $('#facebook-share').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fyoutube.com/watch%3Fv%3D' + vid);
      $('#twitter-share').attr('href', 'http://www.twitter.com/share?&url=http%3A//www.youtube.com/watch%3Fv%3D' + vid);
    }

    adjustSocialShares(vid);

    $('.thumb').click(function() {
      $('#target').attr('class', 'out');
      var time = 450;
      setTimeout(function() {
        $('#target').attr('class', 'in');
      }, time);
      setTimeout(function() {
        $('#target').attr('class', '');
      }, time * 2);
      var vid = $(this).find('.preview').attr('data-vid');
      player.loadVideoById(vid);
      adjustSocialShares(vid);
    });
    initScrollContainer();
  }
  $(window).load(initGallery);

  function initScrollContainer() {
    $('.scroll-container').width($('.thumb').width() * $('.thumb').length);
  }
  $(document).ready(initScrollContainer);
  $(window).resize(initScrollContainer);

  (function() {
    var i;
    var dscroll = 0, totalScroll = 0, tscroll = 0;

    function update() {
      if (dscroll !== 0) { tscroll++; }
      totalScroll += dscroll * (tscroll * 0.75);
      if (totalScroll < 0) { totalScroll = 0; }

      var rightBound = ($('.thumb').length * $('.thumb').width()) - $(window).width();
      if (totalScroll > rightBound) { totalScroll = rightBound; }

      $('.scroll-container').css('margin-left', (-1 * totalScroll) + 'px');
      requestAnimationFrame(update);
    };
    requestAnimationFrame(update);

    $('.scroll-control').hover(function() {
      dscroll = Number($(this).attr('data-scroll'));
    }, function() {
      dscroll = 0;
      tscroll = 0;
    });

  })();
});

//This is for the fittext.js plugin, modify it how you would like!
jQuery(".section-title").fitText(2.0, { minFontSize: '18px', maxFontSize: '36px' })
