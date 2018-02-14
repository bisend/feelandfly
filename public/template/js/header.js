/* left slide bar */
function openNav(e) {
    $('body').css('overflow-x', 'hidden');
    // $('body').animate(300);
    $('.nav-bg').fadeIn(300);


    $('#mySidenav').animate({
        marginLeft: '0px'
    }, 250, 'swing');
}

function closeNav(e) {
    $('body').css('overflow-x', 'auto');
    $('.nav-bg').fadeOut(300);
    $('#mySidenav').animate({
        marginLeft: '-290px'
    }, 250, 'swing');

}

$(document).ready(function () {
    var menuOpenLink = '[data-menu-open-link]',
        menuCloseLink = '[data-menu-close-link]',
        isMenuOpened = false;

    $('body').on('click', menuOpenLink, function (e) {
        e.stopPropagation();
        openNav(e);

        isMenuOpened = true;
    });

    $('body').on('click', menuCloseLink, function (e) {
        e.stopPropagation();
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



/* RIGHT slide bar */
function openNavRight(e) {
    $('body').css('overflow-x', 'hidden');
    $('body').animate(300);
    $('.nav-bg').fadeIn(300);


    $('#mySidenavRight').animate({
        marginRight: '0px'
    }, 250, 'swing');
}

function closeNavRight(e) {
    $('body').css('overflow-x', 'auto');
    $('.nav-bg').fadeOut(300);

    $('#mySidenavRight').animate({
        marginRight: '-290px'
    }, 250, 'swing');
    // $('body').animate({
    //         marginLeft: "0px"
    //      }, 250, 'swing');
}

$(document).ready(function () {
    var menuOpenLinkRight = '[data-menu-open-link-right]',
        menuCloseLinkRight = '[data-menu-close-link-right]',
        isMenuOpenedRight = false;

    $('body').on('click', menuOpenLinkRight, function (e) {
        e.stopPropagation();
        openNavRight(e);

        isMenuOpenedRight = true;
    });

    $('body').on('click', menuCloseLinkRight, function (e) {
        e.stopPropagation();
        closeNavRight(e);

        isMenuOpenedRight = false;
    });

    $(document).on('click', 'body', function (e) {
        var $targetR = $(e.target);

        if (isMenuOpenedRight && ($targetR.attr('id') != 'mySidenavRight' && $targetR.closest('#mySidenavRight').length === 0)) {

            closeNavRight(e);

            isMenuOpenedRight = false;
        }
    });
});
/* RIGHT slide bar END */


/*--- SLICK  NAVBAR  ----*/
$(document).ready(function() {
    var objToStick = $(".header-main"); //Получаем нужный объект
    var topOfObjToStick = $(objToStick).offset().top; //Получаем начальное расположение нашего блока

    $(window).scroll(function () {
        var windowScroll = $(window).scrollTop(); //Получаем величину, показывающую на сколько прокручено окно
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
    });
});
/*--- SLICK  NAVBAR  END ----*/

/*LANG header*/
$(document).ready(function() {
    $('.general-leng').click(function () {
        $('.ather-lang').stop(100,100).fadeToggle(100);
    });
});
/*LANG cart header END*/