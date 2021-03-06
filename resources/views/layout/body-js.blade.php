<script defer src="/template/plugins/main-jquery/jquery-2.2.4.min.js"></script>

{{--<script defer src="/template/plugins/bootstrap/js/bootstrap.min.js"></script>--}}

{{--<script defer src="/template/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>--}}

{{--<script defer src="/template/plugins/prettyphoto-master/js/jquery.prettyPhoto.min.js"></script>--}}

{{--<script defer src="/template/plugins/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>--}}
{{--<script defer src="/template/plugins/jquery-match-height-master/jquery.matchHeight.min.js"></script>--}}

{{--<script defer src="/template/plugins/owl.carousel.2/owl.carousel.min.js"></script>--}}
{{--<script defer src="/template/plugins/waitsync/waitsync.min.js"></script>--}}
{{--<script defer src="/template/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>--}}

<!--Page JS BEGIN-->
@stack('js')
<!--Page JS END-->

<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        $("body").on("click", ".caption-link", function(){
	        fixPreviewToSquer();
        });
    });
    
	function  fixPreviewToSquer(){
    	setTimeout(function(){
	        $(".product-preview-images-small .owl-item").each(function(i, el){
                var $el = $(el),
                    $elW = $el.outerWidth(),
                    img = $el.find("img").eq(0);

            	img.css({
            		"height": $elW,
        		    "object-fit": "cover"
            	});
            });

    	}, 500);
    }
</script>

<script defer src="{{ mix('/js/custom.js') }}"></script>
<script defer src="{{ mix('/js/app.js') }}"></script>
