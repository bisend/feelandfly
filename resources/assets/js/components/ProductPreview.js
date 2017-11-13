if (document.getElementById('grid-view'))
{
    var products = window.FFShop.products;


    var productId = products[0].id;

    var product = [];

    products.forEach(function ($product) {
        if ($product.id == productId)
        {
            product.push($product);
        }
    });

    var GDATA = {
        id: null,
        prodId: 'prod-',
        path: '',
        products: product,
        rel: '',
        relatedUrls: []
    };

    var links = new Vue({
        el: '#grid-view',
        data: GDATA,
        methods: {
            changeId: function (id) {
                // alert(id);
                GDATA.id = id;
                GDATA.prodId = 'prod-' + id;
                GDATA.path = '/img/test/'+ GDATA.id + '-' + GDATA.id + '.jpg';
                
                product = [];

                products.forEach(function ($product) {
                    if ($product.id == id)
                    {
                        product.push($product);
                    }
                });

                GDATA.rel = 'prettyPhoto[category-' + parseInt(id) + ']';

                GDATA.products = product;

                // GDATA.relatedUrls = [];
                // GDATA.products.forEach(function ($product) {
                //     $product.product_group.products.forEach(function ($relatedProduct) {
                //         var id = $relatedProduct.color.id;
                //
                //         var slug = $relatedProduct.slug;
                //
                //         var url = '/product/' + slug;
                //
                //         if (LANGUAGE != DEFAULT_LANGUAGE)
                //         {
                //             url += '/' + LANGUAGE;
                //         }
                //         url = '#000';
                //         GDATA.relatedUrls.push(url);
                //     });
                // });
                // console.log(GDATA.relatedUrls);
                //

            }
        }
    });

    var ids = new Vue({
        el: '#ids',
        data: GDATA,
        updated: function () {
            this.$nextTick(function () {
                
                $container = $('#prod-preview-test');


                //Resize carousels in modal
                if ($('.sync2').length > 0) {
                    $(document).on('shown.bs.modal', function () {
                        $(this).find('.sync1, .sync2').each(function () {
                            $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
                        });
                    });

                    var sync1 = $(".sync1");
                    var sync2 = $(".sync2");
                    var sliderthumb = $(".single-prod-thumb");
                    var homethumb = $(".home-slide-thumb");
                    var navSpeedThumbs = 500;

                    sliderthumb.owlCarousel({
                        rtl: false,
                        items: 3,
                        //loop: true,
                        nav: true,
                        margin: 20,
                        navSpeed: navSpeedThumbs,
                        responsive: {
                            992: {items: 3},
                            767: {items: 4},
                            480: {items: 3},
                            320: {items: 2}
                        },
                        responsiveRefreshRate: 200,
                        navText: [
                            "<i class='fa fa-angle-left'></i>",
                            "<i class='fa fa-angle-right'></i>"
                        ]
                    });

                    sync1.owlCarousel({
                        rtl: false,
                        items: 1,
                        navSpeed: 1000,
                        nav: false,
                        onChanged: syncPosition,
                        responsiveRefreshRate: 200

                    });

                    homethumb.owlCarousel({
                        rtl: false,
                        items: 5,
                        nav: true,
                        //loop: true,
                        navSpeed: navSpeedThumbs,
                        responsive: {
                            1500: {items: 5},
                            1024: {items: 4},
                            768: {items: 3},
                            600: {items: 4},
                            480: {items: 3},
                            320: {items: 2,
                                nav: false
                            }
                        },
                        responsiveRefreshRate: 200,
                        navText: [
                            "<i class='fa fa-long-arrow-left'></i>",
                            "<i class='fa fa-long-arrow-right'></i>"
                        ]
                    });
                }

                function syncPosition(el) {
                    var current = this._current;
                    $(".sync2")
                        .find(".owl-item")
                        .removeClass("synced")
                        .eq(current)
                        .addClass("synced");
                    center(current);
                }

                $(".sync2").on("click", ".owl-item", function (e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.trigger("to.owl.carousel", [number, 1000]);
                    return false;
                });

                function center(num) {

                    var sync2visible = sync2.find('.owl-item.active').map(function () {
                        return $(this).index();
                    });

                    if ($.inArray(num, sync2visible) === -1) {
                        if (num > sync2visible[sync2visible.length - 1]) {
                            sync2.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                        } else {
                            sync2.trigger("to.owl.carousel", Math.max(0, num - 1));
                        }
                    } else if (num === sync2visible[sync2visible.length - 1]) {
                        sync2.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
                    } else if (num === sync2visible[0]) {
                        sync2.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
                    }
                }

                // owlCarousel Slider End //
                
                
                $("a[rel^='prettyPhoto[category-" + GDATA.id + "]']").prettyPhoto({
                    theme: 'facebook',
                    slideshow: 5000,
                    autoplay_slideshow: false,
                    social_tools:false,
                    deeplinking:false,
                    ajaxcallback: function () {
                        var PRETTY_LOADED = true;
                        $container.modal('hide');
                        $container.on('hidden.bs.modal', function () {
                            if (PRETTY_LOADED)
                            {
                                $('body').addClass('modal-open').css('padding-right', '17px');
                                PRETTY_LOADED = false;
                            }
                        });
                    },
                    callback: function () {
                        $('body').removeClass('modal-open').css('padding-right', 0);
                    }
                });
            })
        }
    });

// console.log(window.FFShop.products);

    window.links = links;
    window.ids = ids;
}
