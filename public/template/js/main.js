///////
$('body').on('click', '.dropdown-div-btn', function () {
    var i = $(this).find('.plus-icon');
    var display =  $(this).next().css('display');

    var isFilterBtn = false;

    if ($(this).hasClass('show-filters-btn'))
    {
        isFilterBtn = true;
    }

    i.css('lineHeight', '17px');
    switch (display){
        case 'none': {
            i.html('-');
            i.css('lineHeight', '17px');
            if (isFilterBtn)
            {
                $(this).html(HIDE_FILTERS_BTN);
            }
            break;
        }
        case 'block': {
            i.html('+');
            i.css('lineHeight', '20px');
            if (isFilterBtn)
            {
                $(this).html(SHOW_FILTERS_BTN);
            }
            // $(this).css('borderBottom', 'none')
            // $(this).html($(this).html().replace('Сховати','Показати'))
            break
        }
        default: {
            break
        }
    }
    $(this).next().stop().slideToggle(300);
});
/* DROPDOWN - BLOCK END*/

/* select  */

$('body').on('click', '.drop-menu-select:not(.disableDiv)', function () {

    if ($(this).find('#mu-list').length > 0 && $('#data-values #GoodId').val() > 0) {
        event.preventDefault();
        return false;
    }

    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropeddown').stop(true, true).slideToggle(300);
    $(this).css({
        color: '#555',
        fontWeight: '500',
        border: '2px solid #000'
    });
});
$('body').on('focusout', '.drop-menu-select', function () {
    $(this).removeClass('active');
    $(this).find('.dropeddown').stop(true, true).slideUp(300);
});
$('body').on('click','.drop-menu-select .dropeddown li:not(.select-multi)', function () {
    $(this).parents('.drop-menu-select').find('.select span').text($(this).text());
    $(this).parents('.drop-menu-select').find('input').attr('value', $(this).attr('id'));
});

/* select end */