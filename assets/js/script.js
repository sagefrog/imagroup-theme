jQuery(document).ready(function() {

    
    menuMobile();

    function menuMobile() {
        jQuery('.sk-offcanvas-content ul.sk-mobile-menu > li:has(ul)').addClass("has-sub");
        jQuery('.sk-offcanvas-content ul.sk-mobile-menu > li:has(ul) > a').after('<span class="caret"></span>');
        jQuery(document).on('click', '.sk-offcanvas-content ul.sk-mobile-menu > li > .caret', function(e) {
            e.preventDefault();
            var checkElement = jQuery(this).next();
            jQuery('.sk-offcanvas-content ul.sk-mobile-menu > li').removeClass('menu-active');
            jQuery(this).closest('li').addClass('menu-active');

            if ((checkElement.is('.sub-menu')) && (checkElement.is(':visible'))) {
                jQuery(this).closest('li').removeClass('menu-active');
                checkElement.slideUp('normal');
            }

            if ((checkElement.is('.sub-menu')) && (!checkElement.is(':visible'))) {
                jQuery('.sk-offcanvas-content ul.sk-mobile-menu .sub-menu:visible').slideUp('normal');
                checkElement.slideDown('normal');
            }

            if (checkElement.is('.sub-menu')) {
                return false;
            } else {
                return true;
            }
        });

        jQuery(document).on('click', '.canvas-menu.sk-offcanvas > a.sk-dropdown-toggle', function(e) {
            e.preventDefault();
            var jQuerystyle = jQuery(this).data('canvas');
            if (jQuery('.sk-offcanvas-content' + jQuerystyle).hasClass('open')) {
                jQuery('.sk-offcanvas-content' + jQuerystyle).removeClass('open');
                jQuery('#sk-overlay').removeClass('open');
                jQuery('.sk-dropdown-toggle').removeClass('open');
                jQuery('#wp-main-content').removeClass('blur');
                jQuery('body').removeClass('sk-hidden');
            } else {
                jQuery('.sk-offcanvas-content' + jQuerystyle).addClass('open');
                jQuery('#sk-overlay').addClass('open');
                jQuery('.sk-dropdown-toggle').addClass('open');
                jQuery('#wp-main-content').addClass('blur');
                jQuery('body').addClass('sk-hidden');
            }
        });

        jQuery('.sk-nav-menu li a').on('click',function(){
            jQuery('.sk-offcanvas-content').removeClass('open');
            jQuery('#sk-overlay').removeClass('open');
            jQuery('.sk-dropdown-toggle').removeClass('open');
            jQuery('#wp-main-content').removeClass('blur');
            jQuery('body').removeClass('sk-hidden');
        });

    }


    // Scroll top top
    jQuery('.scroll-top').on('click',function() {
      jQuery("html, body").animate({ scrollTop: 0 }, 500);
      return false;
    });


    initBg();
    setHeight();
    equalheight('.equal-h1');

    // Move to review tab
    jQuery('.scroll-down').on("click", function() {
        var id = jQuery(this).attr('href');
        moveTo(id);
    });

    /*Wow Animations*/
    if (jQuery(".wow").length) {
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        new WOW().init();
    }

    // Initialize fancybox
    jQuery('[data-fancybox="gallery"]', '[data-fancybox]').fancybox({
        buttons: [
            'share',
            'fullScreen',
            'close'
        ]
    });

    // custom select js
    jQuery(function() {
        jQuery('.selectpicker').selectpicker();
    });

    // Initialize form style
    jQuery(function() {
        jQuery('select.select-dropbox, input[type="radio"], input[type="checkbox"]').styler({
            selectSearch: false,
        });
    });

    jQuery('.course-accordion .accordion-item').each('click', function() {
        if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active');
        } else {
            jQuery(this).addClass('active');
            jQuery(this).siblings('.accordion-item').removeClass('active');          
        }
    });

    // Initialize sidebar-sticky
    if (jQuery('.content-row .sidebar').length) {
        var sidebar = new StickySidebar('.sidebar', {
            containerSelector: '.content-row',
            innerWrapperSelector: '.content-row .row',
            topSpacing: 140,
            bottomSpacing: 20,
            resizeSensor: true,
            minWidth: 768
        });
    }


    // button hover effect....
    // jQuery(function() {
    //     jQuery('.main-btn')
    //         .on('mouseenter', function(e) {
    //             var parentOffset = jQuery(this).offset(),
    //                 relX = e.pageX - parentOffset.left,
    //                 relY = e.pageY - parentOffset.top;
    //             jQuery(this).find('span').css({
    //                 top: relY,
    //                 left: relX
    //             })
    //         })
    //         .on('mouseout', function(e) {
    //             var parentOffset = jQuery(this).offset(),
    //                 relX = e.pageX - parentOffset.left,
    //                 relY = e.pageY - parentOffset.top;
    //             jQuery(this).find('span').css({
    //                 top: relY,
    //                 left: relX
    //             })
    //         });
    //     //jQuery('[href=#]').click(function(){return false});
    // });
    

    // Owl Carousel For All product slider
    if (jQuery('.owl-carousel').length) {

        jQuery('.owl-carousel').each(function() {

            var owl = jQuery('.owl-carousel');

            jQuery(this).owlCarousel({
                margin: jQuery(this).data('margin'),
                center: jQuery(this).data('center'),
                loop: jQuery(this).data('loop'),
                smartSpeed: jQuery(this).data('speed'),
                autoplay: jQuery(this).data('autoplay'),
                items: jQuery(this).data('carousel-items'),
                nav: jQuery(this).data('nav'),
                dots: jQuery(this).data('dots'),
                vertical: true,
                responsive: {
                    0: {
                        items: jQuery(this).data('xs'),
                        margin: jQuery(this).data('margin-xs')
                    },
                    576: {
                        items: jQuery(this).data('mobile'),
                        margin: jQuery(this).data('margin-sm')
                    },
                    768: {
                        items: jQuery(this).data('tablet'),
                        margin: jQuery(this).data('margin-md')
                    },
                    992: {
                        items: jQuery(this).data('laptop'),
                        margin: jQuery(this).data('margin-lg')
                    },
                    1200: {
                        items: jQuery(this).data('desktop'),
                        margin: jQuery(this).data('margin-xl')
                    },
                    1500: {
                        items: jQuery(this).data('items'),
                        margin: jQuery(this).data('margin-xxl')
                    }
                }
            });
        });
    }

    jQuery(".post-comment-blog").slice(0,3).css('display', 'flex');
    jQuery(".load-more").click(function(e){
        e.preventDefault();
        jQuery(".post-comment-blog:hidden").slice(0,3).css('display', 'flex');

        if(jQuery(".post-comment-blog:hidden").length == 0){
           jQuery(".load-more").fadeOut("");
          }
    });
    

    var swiper = new Swiper(".hero-slider", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        speed: 2000,
        effect: "fade",
    });

    var swiper = new Swiper(".glace-slider", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        speed: 2000,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        // direction: "vertical",
        // breakpoints: {
        //     768: {
        //         direction: "horizontal",
        //     }
        // },
    });


    
    jQuery('.counter').countUp();
    
    
});


jQuery(window).on('load', function() {

    
    initBg();
    setHeight();
    equalheight('.equal-h1');

    // message success modal open
    jQuery('#successModal').modal('show');

    (function detectIE() {
        var ua = window.navigator.userAgent;

        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
            // IE 10 or older => return version number
            var ieV = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            document.querySelector('body').className += ' IE';
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
            // IE 11 => return version number
            var rv = ua.indexOf('rv:');
            var ieV = parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
            document.querySelector('body').className += ' IE';
        }

        var edge = ua.indexOf('Edge/');
        if (edge > 0) {
            // IE 12 (aka Edge) => return version number
            var ieV = parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
            document.querySelector('body').className += ' IE';
        }

        return false;
    })();

     
    
});

jQuery(window).on('resize', function() {

    initBg();
    setHeight();
    equalheight('.equal-h1');
   

});

jQuery(window).on('scroll', function() {
    if (jQuery(window).scrollTop() >= 100) {
        jQuery('.header-part').addClass('sticky');

    }
    if (jQuery(window).scrollTop() < 100) {
        jQuery('.header-part').removeClass('sticky');

    } 
    if (jQuery(window).scrollTop() >= 150) {
        jQuery('.header-part').addClass('showed');
    } else {
        jQuery('.header-part').removeClass('showed');
    }

    if (jQuery(window).scrollTop() >= 800) {
        jQuery('.scroll-top').addClass('sticky');
    } else {
        jQuery('.scroll-top').removeClass('sticky');
    }
});


function setHeight() {
    windowHeight = jQuery(window).innerHeight();
    //jQuery('body').css('padding-top', jQuery('.header-part').outerHeight());
    //jQuery('.hero-home').css('height', jQuery(window).height());
    //jQuery('.mission-gallery').css('height', jQuery('.get-height').outerHeight());
    // jQuery('.banner-part').css('height', jQuery(window).height());

};


function initBg() {
    jQuery('.banner-bg').each(function() {
        var background = jQuery(this).data('background');
        jQuery(this).css('background-image', 'url("' + background + '")');
    });
}

// Move to top
function moveTo(id) {
    
    jQuery('html,body').animate({
        scrollTop: jQuery(id).offset().top - 100
    }, 1200);
    return false;
}

equalheight = function(container) {
    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        jQueryel,
        topPosition = 0;
    jQuery(container).each(function() {

        jQueryel = jQuery(this);
        jQuery(jQueryel).outerHeight('auto')
        topPostion = jQueryel.position().top;

        if (currentRowStart != topPostion) {
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].outerHeight(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = jQueryel.outerHeight();
            rowDivs.push(jQueryel);
        } else {
            rowDivs.push(jQueryel);
            currentTallest = (currentTallest < jQueryel.outerHeight()) ? (jQueryel.outerHeight()) : (currentTallest);
        }
        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
            rowDivs[currentDiv].outerHeight(currentTallest);
        }
    });
}