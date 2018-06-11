/* left slide bar */
function openNav(e) {
    $('#mySidenav').animate({
        marginLeft: '0px'
    }, 250, 'swing', function () {
        $('body').css('overflow-x', 'hidden');
        $('body').css('overflow-y', 'hidden');
    });

    setTimeout(function () {
        $('.nav-sidebar-bg').fadeIn(150);
    }, 100);
}

function closeNav(e) {
    $('body').css('overflow-x', 'auto');
    $('body').css('overflow-y', 'auto');
    $('.nav-sidebar-bg').fadeOut(250);
    $('#mySidenav').animate({
        marginLeft: '-290px'
    }, 250, 'swing');

}

function fixedPositionBtnMenu(){
    var parentLeft = $("[data-menu-open-link]").closest(".container").offset().left + 15;
    $("[data-menu-open-link]").css("left", parentLeft);
}

$(document).ready(function () {
    fixedPositionBtnMenu();

    var menuOpenLink = '[data-menu-open-link]',
        menuCloseLink = '[data-menu-close-link]',
        isMenuOpened = false;

    $('body').on('click touchend', menuOpenLink, function (e) {
        e.stopPropagation();
        openNav(e);

        isMenuOpened = true;
    });

    $('body').on('click', menuCloseLink, function (e) {
        e.stopPropagation();
        closeNav(e);

        isMenuOpened = false;
    });

    $('body').on('click', '[data-close-sidebar-nav]', function (e) {
        closeNav(e);

        isMenuOpened = false;
    });

    $(document).on('click', 'body', function (e) {
        var $target = $(e.target);

        if (isMenuOpened && ($target.attr('id') != 'mySidenav' && $target.closest('#mySidenav').length === 0))
        {
            closeNav(e);
            isMenuOpened = false;
        }
    });
});
/* left slide bar END */

var SHOW_HEADER_TOP_BAR = false;

/*--- SLICK  NAVBAR  ----*/
$(window).load(function() {

    if ($(window).width() > 991)
    {
        SHOW_HEADER_TOP_BAR = true;
    }
    else
    {
        $('.header-topbar').css('display', 'none');
    }

    var objToStick = $(".header-main"); //Получаем нужный объект
    var topOfObjToStick = $(objToStick).offset().top; //Получаем начальное расположение нашего блока
    $(window).scroll(function () {
        var windowScroll = $(window).scrollTop(); //Получаем величину, показывающую на сколько прокручено окно

        if (SHOW_HEADER_TOP_BAR)
        {
            if (windowScroll > topOfObjToStick)
            { // Если прокрутили больше, чем расстояние до блока, то приклеиваем его
                $('.header-topbar').slideUp(200, function() {
                    $(objToStick).addClass("topWindow");
                });
            }
            else
            {
                $('.header-topbar').slideDown(400);
                $(objToStick).removeClass("topWindow");
            }
        }
    });




});
/*--- SLICK  NAVBAR  END ----*/

$(window).resize(function() {
    fixedPositionBtnMenu();

    if ($(window).width() <= 991)
    {
        SHOW_HEADER_TOP_BAR = false;
        $('.header-topbar').css('display', 'none');
    }
    else
    {
        SHOW_HEADER_TOP_BAR = true;
        $('.header-topbar').slideDown(400);
        $(".header-main").removeClass("topWindow");
    }
});

/*LANG header*/
$(document).ready(function() {
    $('.general-leng').click(function () {
        $('.ather-lang').stop(100,100).fadeToggle(100);
    });
});
/*LANG cart header END*/