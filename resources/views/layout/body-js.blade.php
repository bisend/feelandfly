<script defer src="/template/plugins/main-jquery/jquery-2.2.4.min.js"></script>
<script defer src="/template/plugins/bootstrap/js/bootstrap.min.js"></script>
<script defer src="/template/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script defer src="/template/plugins/prettyphoto-master/js/jquery.prettyPhoto.min.js"></script>
<script defer src="/template/plugins/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
<script defer src="/template/plugins/jquery-match-height-master/jquery.matchHeight.min.js"></script>
<script defer src="/template/plugins/owl.carousel.2/owl.carousel.min.js"></script>
<script defer src="/template/plugins/waitsync/waitsync.min.js"></script>
<script defer src="/template/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

<!--Page JS BEGIN-->
@stack('js')
<!--Page JS END-->

<script defer src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>

<script>
    $(window).ready(function(){
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            // fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            // prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="display: block;"><i class="fa fa-angle-left"></i></button>',
            // nextArrow: '<i class="fa fa-angle-right"></i>',
            dots: false,
            focusOnSelect: true,
            vertical: true
        });

        $('a[data-slide]').click(function(e) {
            e.preventDefault();
            var slideno = $(this).data('slide');
            $('.slider-nav').slick('slickGoTo', slideno - 1);
        });

        var containerWidth = $(".slider-nav").outerWidth();
        $(".slider-nav img").each(function(i, img){
        	$(img).css({
        		"width": containerWidth,
        		"heigth": containerWidth
        	});
        });
    });
</script>

<script defer src="{{ mix('/js/custom.js') }}"></script>
<script defer src="{{ mix('/js/app.js') }}"></script>
