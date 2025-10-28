
(function ($) {
  "use strict";

  var d = document;
  var c = 'click';

  $(document).ready(function () {
  // ========================= Sponsor Slider Js Start =====================
    $('.brand-slider').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1000,
      speed: 2000 ,
      dots: false,
      arrows: false,
      prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
      responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow:4,
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 400,
            settings: {
              slidesToShow: 2
            }
          }
        ]
    });
    // ========================= Sponsor Slider Js End =====================

    // ========================= Home one Magnific Popup Js Start =====================
    $('.popup-video').magnificPopup({
      type: 'iframe'
    });
    // ========================= Home one Magnific Popup Js End =====================

    // =========================Home Two Magnific Popup Js End =====================
    $('.work-popup-img').magnificPopup({
      type: 'image',
      gallery:{
        enabled:true
      }
    });
    // ========================= Home Two Magnific Popup Js Start =====================

    // ========================= Home one Slick Slider Js Start =====================
    $('.testimonial-slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      centerMode: true,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: false,
      arrows: false,
      prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
      responsive: [
          {
            breakpoint: 1199,
            settings: {
              arrows: false,
              slidesToShow: 2,
              dots: false,
            }
          },
          {
            breakpoint: 991,
            settings: {
              arrows: false,
              slidesToShow: 2
            }
          },
          {
            breakpoint: 767,
            settings: {
              arrows: false,
              dots: true,
              slidesToShow: 1
            }
          }
        ]
    });
    // ========================= Home one Slick Slider Js End =====================

    // =========================Home Two Slick Slider Js Start =====================
    $('.testi-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: false,
      arrows: false,
      prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
      responsive: [
        {
          breakpoint: 991,
          settings: {
            arrows: false,
            dots: true,
            slidesToShow: 1
          }
        }
      ]
    });
    // ========================= Home Two Slick Slider Js End =====================

    // ========================= Slick Slider Js Start =====================
    $('.more-service-slider').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: false,
      arrows: true,
      nextArrow: '<button type="button" class="slick-prev"><i class="las la-angle-right"></i></button>',
      prevArrow: '<button type="button" class="slick-next"><i class="las la-angle-left"></i></button>',
      responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 2,
              dots: false,
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 767,
            settings: {
              dots: false,
              slidesToShow: 1
            }
          },
          {
            breakpoint: 575,
            settings: {
              arrows: false,
              dots: true,
              slidesToShow: 1
            }
          }
        ]
    });
    // ========================= Home Two Slick Slider Js End =====================

    // ========================= Toggle Search Js Start =====================
    $('.search-icon').on('click', function() {
      $('.search-input').toggleClass('show')
      $('.search-icon').toggleClass('close');
    });
    // ========================= Toggle Search Js End =====================

    // ========================= Blog Share Start =====================
    $('.blog-share').on('click', function() {
      if($(this).find('.popup-share-icons').hasClass('show')){
        $(this).find('.popup-share-icons').removeClass('show');
      }else{
        $(this).find('.popup-share-icons').addClass('show');
      }
      if($('.blog-share').find('.show').length > 1){
        $('.popup-share-icons').removeClass('show');
        return $(this).find('.popup-share-icons').addClass('show');
      }
    });
    // ========================= Blog Share End =====================

    // ========================= Odometer Counter Js End =====================
    // Odometer Counter
    $(".counterup-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
            var el = document.querySelectorAll('.odometer')[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    });
    // ========================= Counter Js End =====================

  });

    // ========================= Preloader Js Start =====================
    $(window).on("load", function(){
      $('.preloder').fadeOut(); 
    })
    // ========================= Preloader Js End=====================
  
    // ========================= Header Sticky Js Start =====================
    $(window).on('scroll', function() {
      if ($(window).scrollTop() >= 300) {
        $('.header-bottom').addClass('fixed-header');
      }
      else {
          $('.header-bottom').removeClass('fixed-header');
      }
    }); 
    // ========================= Header Sticky Js End=====================
    //================================= Scroll To Top Icon Js Start =========================
    var btn = $('.scroll-top');
    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });
    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
    //================================= Scroll To Top Icon Js End ===========================

})(jQuery);








