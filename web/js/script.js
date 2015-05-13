    $(document).ready(function() {
        /*nav bar scroll*/
        $(window).scroll(function() {
            if ($(this).scrollTop() > 400) {
                $('nav.navbar.desktop').animate({
                    opacity: 1,
                    height: "40px",
                }, 300, function() {
                    $('nav.navbar.desktop').css('line-height', '50px');
                    $('nav a.logo').addClass('scroll');
                });
            } else if ($(this).scrollTop() < 400) {
                $('nav.navbar.desktop').animate({
                    opacity: 0.7,
                    height: "86px"
                }, 100, function() {
                    $('nav.navbar.desktop').css('line-height', '86px');
                    $('nav a.logo').removeClass('scroll');
                });
            }
        });

        /* fleche top */
        $('.fleche_top').on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
            return false;
        });

        /* voyage hover */

        $('.inclus_vol').hover(function() {
            $('.info_inclus').toggleClass('bloc_block');
        });

        $('#myCarousel a').on('click', function() {
            $.scrollTo($(this).attr("href"), "slow");
            return false;
        });
        
        

        /* tab JS
        $('#myTab a').click(function (e) {
          e.preventDefault()
          $(this).tab('show');
          fakewaffle.responsiveTabs(['xs', 'sm'])
        });*/

        /*nav mobile */
        $('.navbar.mobile ul').css('display', 'none');
        $('a#toggle').on('click', function() {
            $('.navbar.mobile ul').slideToggle(500);
        });


        $('.carousel').carousel();

        
    });

    //menu mobile
    var theToggle = document.getElementById('toggle');

    // based on Todd Motto functions
    // http://toddmotto.com/labs/reusable-js/

    // hasClass
    function hasClass(elem, className) {
            return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
        }
        // addClass
    function addClass(elem, className) {
            if (!hasClass(elem, className)) {
                elem.className += ' ' + className;
            }
        }
        // removeClass
    function removeClass(elem, className) {
            var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
            if (hasClass(elem, className)) {
                while (newClass.indexOf(' ' + className + ' ') >= 0) {
                    newClass = newClass.replace(' ' + className + ' ', ' ');
                }
                elem.className = newClass.replace(/^\s+|\s+$/g, '');
            }
        }
        // toggleClass
    function toggleClass(elem, className) {
        var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, " ") + ' ';
        if (hasClass(elem, className)) {
            while (newClass.indexOf(" " + className + " ") >= 0) {
                newClass = newClass.replace(" " + className + " ", " ");
            }
            elem.className = newClass.replace(/^\s+|\s+$/g, '');
        } else {
            elem.className += ' ' + className;
        }
    }

    theToggle.onclick = function() {
        toggleClass(this, 'on');
        return false;
    }

