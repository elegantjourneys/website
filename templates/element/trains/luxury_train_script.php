<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=WEBROOT?>version2/assets/js/script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

  <script

    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"

    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"

    crossorigin="anonymous"></script>


  <script src="../trains/assets/js/menu.js?v=3"></script>
  <script src="../trains/assets/js/script.js?v=1"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en', // Set your site's default language
        includedLanguages: 'en,de,it,fr,ru,tr',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }
  </script>
  <script>
    $(document).ready(function() {
      $("#service-provider").click(function() {
        $(".pop-item").toggle();
      });

    });
  </script>
  <script>
    $(function() {
      var $header = $('#orange-div');
      var $placeholder = $('#orange-placeholder');

      $(window).on('scroll', function() {
        if ($(this).scrollTop() >= 120) {
          if (!$header.hasClass('fixed-top')) {
            $placeholder.height($header.outerHeight());
            $header.addClass('fixed-top');
            $('#banner').addClass('mt-9');
          }
        } else {
          $header.removeClass('fixed-top');
          $placeholder.height(0);
          $('#banner').removeClass('mt-9');
        }
      });
    });
    $(window).on('scroll', function() {
      var $header = $('#header-mob');

      if ($(this).scrollTop() >= 120) {
        $header.addClass('fixed-header');
      } else {
        $header.removeClass('fixed-header');
      }
    });
  </script>

  <script>
    $(function() {
      const text = $(".marquee-text");
      const block = $(".block");
      const clone = text;

      const anim = () => {
        $(clone).clone().appendTo($(block));
        $(".block").animate({
            left: "-100%",
          },
          45000, // Increased from 7000 to 15000 for slower animation
          "linear",
          function() {
            $(".marquee-text").first().remove();
            $(block).css("left", "0");
            anim();
          }
        );
      };

      const blockList = $(".block-list");
      const list = $(".marquee-list");
      const listWidth = list.width() + parseInt($(blockList).css("gap"));
      $(list).clone().appendTo($(blockList));

      const animList = () => {
        $(list).clone().appendTo($(blockList));
        $(blockList).animate({
            left: -listWidth,
          },
          55000, // Increased from 12000 to 25000 for slower animation
          "linear",
          function() {
            $(".list").first().remove();
            $(blockList).css("left", "0");
            animList();
          }
        );
      };

      anim();
      animList();
    });
  </script>

  <script>
    $(document).ready(function() {
      $(".slider").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        speed: 500,
        autoplaySpeed: 3000,
        autoplay: true,
        centerMode: true,
        centerPadding: "0",
        responsive: [{
            breakpoint: 1024, // tablets and below
            settings: {
              slidesToShow: 2,
              centerMode: false,
            }
          },
          {
            breakpoint: 768, // mobile landscape
            settings: {
              slidesToShow: 1,
              centerMode: false,
            }
          },
          {
            breakpoint: 480, // small phones
            settings: {
              slidesToShow: 1,
              centerMode: false,
            }
          }
        ]
      });

    });
  </script>
  <script>
    jQuery(document).ready(function($) {
      var owl = $("#owl-demo");
      owl.owlCarousel({
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        items: 3,
        loop: true,
        center: false,
        smartSpeed: 550,
        fluidSpeed: false,
        dragEndSpeed: false,
        responsive: {
          0: {
            items: 1
            // nav: true
          },
          480: {
            items: 2,
            nav: false
          },
          768: {
            items: 3,
            // nav: true,
            loop: true
          },
          992: {
            items: 3,
            // nav: true,
            loop: true
          }
        },
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,
        fallbackEasing: "swing",
        info: false,
        nestedItemSelector: false,
        itemElement: "div",
        stageElement: "div",
        refreshClass: "owl-refresh",
        loadedClass: "owl-loaded",
        loadingClass: "owl-loading",
        rtlClass: "owl-rtl",
        responsiveClass: "owl-responsive",
        dragClass: "owl-drag",
        itemClass: "owl-item",
        stageClass: "owl-stage",
        stageOuterClass: "owl-stage-outer",
        grabClass: "owl-grab",
        autoHeight: false,
        lazyLoad: false
      });

      $(".next").click(function() {
        owl.trigger("owl.next");
      });
      $(".prev").click(function() {
        owl.trigger("owl.prev");
      });
    });
  </script>
  <script>
    jQuery(document).ready(function($) {
      var owl = $("#owl-demo-a");
      owl.owlCarousel({
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        items: 3,
        loop: true,
        center: false,
        smartSpeed: 550,
        fluidSpeed: false,
        dragEndSpeed: false,
        responsive: {
          0: {
            items: 1
            // nav: true
          },
          480: {
            items: 1,
            nav: false
          },
          768: {
            items: 2,
            // nav: true,
            loop: false,
            autoplay: false,
          },
          992: {
            items: 2,
            // nav: true,
            loop: false,
            autoplay: false,
          }
        },
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,
        fallbackEasing: "swing",
        info: false,
        nestedItemSelector: false,
        itemElement: "div",
        stageElement: "div",
        refreshClass: "owl-refresh",
        loadedClass: "owl-loaded",
        loadingClass: "owl-loading",
        rtlClass: "owl-rtl",
        responsiveClass: "owl-responsive",
        dragClass: "owl-drag",
        itemClass: "owl-item",
        stageClass: "owl-stage",
        stageOuterClass: "owl-stage-outer",
        grabClass: "owl-grab",
        autoHeight: false,
        lazyLoad: false
      });

      $(".next").click(function() {
        owl.trigger("owl.next");
      });
      $(".prev").click(function() {
        owl.trigger("owl.prev");
      });
    });
  </script>
  <script>
    var owl = $('.screenshot_slider').owlCarousel({
      loop: true,
      responsiveClass: true,
      nav: false,
      margin: 20,
      autoplayTimeout: 4000,
      autoplay: true,
      smartSpeed: 400,
      //center: false,
      navText: ['&#8592;', '&#8594;'],
      responsive: {
        0: {
          items: 1,
          margin: 0
        },
        600: {
          items: 2.2,
          margin: 0
        },
        1000: {
          items: 1.3,
          margin: 30
        },
        1400: {
          items: 2.7,
          margin: 30
        },
        1200: {
          items: 2.3,
          margin: 30
        },
        1600: {
          items: 2.5,
          margin: 30
        }
      }
    });
    $('.item-ext').on('click', function() {
      const contentId = $(this).data('id');
      
      const modalContent = $('#' + contentId).html();
	//alert(modalContent);
      $('#modalBodyContent').html(modalContent);
      const myModal = new bootstrap.Modal(document.getElementById('carouselModal'));
      myModal.show();
    });


    function setFirstZoomItem() {
      $('.screenshot_slider .owl-item').removeClass('zoom');
      $('.screenshot_slider .owl-item.active').first().addClass('zoom');
    }

    setFirstZoomItem();

    owl.on('changed.owl.carousel', function() {
      setTimeout(setFirstZoomItem, 50);
    });


    jQuery(document.documentElement).keydown(function(event) {
      // handle cursor keys
      if (event.keyCode == 37) {
        // go left
        owl.trigger('prev.owl.carousel', [400]);
        //owl.trigger('owl.prev');
      } else if (event.keyCode == 39) {
        // go right
        owl.trigger('next.owl.carousel', [400]);
        //owl.trigger('owl.next');
      }

    });
  </script>
  <script>
    $(function() {
      "use strict";

      $(".galleryVid .videoTag").click(function() {
        var $srcvid = $(this).find("source").attr("src");
        $(".showvideo").fadeIn();
        $(".vid-show video").attr("src", $srcvid)[0].play(); // Auto-play the new video

        // Play the clicked video if needed
        $(this).find('video')[0].play();
      });

      $(".close, .overlay").click(function() {
        $(".showvideo").fadeOut();
        $('video').trigger('pause');
      });

    });
  </script>
  <script>
    $(function() {
      $('.open-youtube').click(function() {
        const videoId = $(this).data('video-id');
        const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        $('#youtube-frame').attr('src', embedUrl);
        $('.youtube-popup').fadeIn();
      });

      $('.youtube-popup .close, .youtube-popup .overlay').click(function() {
        $('.youtube-popup').fadeOut();
        $('#youtube-frame').attr('src', ''); // stop the video
      });



    });

    /* $(function() {
      var headerOffset = 250;

      $('a[href^="#"]').on('click', function(e) {
        var targetId = $(this).attr('href');
        var $target = $(targetId);
        if ($target.length) {
          e.preventDefault();

          // If header isnt fixed yet, force scroll a bit to trigger fixed-top
          if (!$('#orange-div').hasClass('fixed-top') && $(window).scrollTop() < 300) {
            $('html, body').animate({
              scrollTop: 301
            }, 10);
          }

          // Wait a moment to ensure layout is updated before scrolling to target
          setTimeout(function() {
            $('html, body').animate({
              scrollTop: $target.offset().top - headerOffset
            }, 600);
          }, 50);
        }
      });
    }); */
    $(function() {
  var headerOffset = 250;

  $('a[href^="#"]').on('click', function(e) {
    var targetId = $(this).attr('href');

    // Skip behavior if link points to #contact-enquiry-form
    if (targetId === '#contact-enquiry-form') {
      //return; // do nothing
      var headerOffset = 150;
    }

    var $target = $(targetId);
    if ($target.length) {
      e.preventDefault();

      // If header isn't fixed yet, force scroll a bit to trigger fixed-top
      if (!$('#orange-div').hasClass('fixed-top') && $(window).scrollTop() < 300) {
        $('html, body').animate({
          scrollTop: 301
        }, 10);
      }

      // Wait a moment to ensure layout is updated before scrolling to target
      setTimeout(function() {
        $('html, body').animate({
          scrollTop: $target.offset().top - headerOffset
        }, 600);
      }, 50);
    }
  });
});

  </script>
  <script>
    $(function() {
      $('.reveal-text').on('click', function() {
        const $reveal = $(this);
        const $price = $reveal.siblings('.price-text');

        $reveal.hide();
        $price.show();

        setTimeout(function() {
          $price.hide();
          $reveal.show();
        }, 10000); // 10 seconds
      });
    });
  </script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>

  <script>
    document.getElementById("claimNowBtn").addEventListener("click", function() {
      document.getElementById("claimStep").classList.add("d-none"); // hide claim now section
      const form = document.getElementById("tarrifForm");
      form.classList.remove("d-none"); // show form
      form.classList.add("animate__animated", "animate__fadeIn"); // optional fade-in animation
    });
  </script>

  <script>
    const enquiryModal = document.getElementById('popper-popup');

    enquiryModal.addEventListener('show.bs.modal', function() {
      // Always reset to step 1 when modal opens
      document.getElementById("claimStep").classList.remove("d-none");
      document.getElementById("tarrifForm").classList.add("d-none");

      // Also reset the form
      const form = enquiryModal.querySelector('#tarrifForm');
      if (form) {
        form.reset();
      }

      // Refresh captcha
      const captchaImg = enquiryModal.querySelector('#tcaptchaImage');
      if (captchaImg) {
        captchaImg.src = 'tcaptcha.php?rand=' + Date.now();
      }

      // set price dynamically if data-price exists on trigger
      const trigger = event.relatedTarget;
      if (trigger) {
        const price = trigger.getAttribute('data-price');
        if (price) {
          document.getElementById('modalPrice').textContent = price;
        }
      }
    });
  </script>