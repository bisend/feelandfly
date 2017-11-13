//
// $(".cart-hover").hover(function () {
//     $('.cart-hover .pop-up-box').slideToggle(400);
// });


$( ".dropdown-div-btn" ).click(function() {
     var i = $(this).find('.plus-icon');
    var display =  $(this).next().css('display');
    i.css('lineHeight', '17px');
    switch (display){
        case 'none': {
             i.html('-');
             i.css('lineHeight', '17px');
            // $(this).html($(this).html().replace('Показати','Сховати'))
            break;
        }
        case 'block': {
            i.html('+');
            i.css('lineHeight', '20px');
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

