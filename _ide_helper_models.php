<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Blog
 *
 * @property int $id
 * @property int $image_id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $slug
 * @property string|null $description_ru
 * @property string|null $description_uk
 * @property string|null $short_description_ru
 * @property string|null $short_description_uk
 * @property int $number_of_views
 * @property string|null $code_1c
 * @property int $priority
 * @property bool $is_visible
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\DatabaseModels\Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereNumberOfViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereShortDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereShortDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Blog extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Category
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property string|null $description_ru
 * @property string|null $description_uk
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_visible
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereIsVisible($value)
 * @property string|null $icon
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereIcon($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Category[] $childs
 * @property-read \App\DatabaseModels\Category|null $parent
 * @property int|null $meta_tag_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaTagId($value)
 * @property-read \App\DatabaseModels\MetaTag $meta_tag
 * @property string|null $meta_title_ru
 * @property string|null $meta_title_uk
 * @property string|null $meta_description_ru
 * @property string|null $meta_description_uk
 * @property string|null $meta_keywords_ru
 * @property string|null $meta_keywords_uk
 * @property string|null $meta_h1_ru
 * @property string|null $meta_h1_uk
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaH1Ru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaH1Uk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category whereMetaTitleUk($value)
 * @property string|null $picture_size_id
 * @property-read \App\DatabaseModels\PictureSize $pictureSize
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category wherePictureSizeId($value)
 * @property string|null $picture_size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Category wherePictureSize($value)
 */
	class Category extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\CheckoutPoint
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property bool $is_visible
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\CheckoutPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CheckoutPoint extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Color
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property string $html_code
 * @property int|null $image_id
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereHtmlCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Color whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Color extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Delivery
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_visible
 * @property int $priority
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Delivery wherePriority($value)
 */
	class Delivery extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\DeliveryType
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property bool $is_visible
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\DeliveryType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class DeliveryType extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Image
 *
 * @property int $id
 * @property string|null $original
 * @property string|null $big
 * @property string|null $medium
 * @property string|null $small
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_visible
 * @property int $priority
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image wherePriority($value)
 */
	class Image extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\MainSlider
 *
 * @property int $id
 * @property int $image_id
 * @property int $priority
 * @property bool $is_visible
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\DatabaseModels\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\MainSliderMarker[] $markers
 * @property string|null $url_ru
 * @property string|null $url_uk
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereUrlUk($value)
 */
	class MainSlider extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\MainSliderMarker
 *
 * @property int $id
 * @property int $slide_id
 * @property int $product_id
 * @property int $priority
 * @property bool $is_visible
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereSlideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\DatabaseModels\Product $product
 * @property int|null $position_x
 * @property int|null $position_y
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker wherePositionX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker wherePositionY($value)
 */
	class MainSliderMarker extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\MetaTag
 *
 * @property int $id
 * @property string $page_name
 * @property string $title_ru
 * @property string $title_uk
 * @property string $description_ru
 * @property string $description_uk
 * @property string $keywords_ru
 * @property string $keywords_uk
 * @property string $h1_ru
 * @property string $h1_uk
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereH1Ru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereH1Uk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag wherePageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $meta_title_ru
 * @property string $meta_title_uk
 * @property string $meta_description_ru
 * @property string $meta_description_uk
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_uk
 * @property string $meta_h1_ru
 * @property string $meta_h1_uk
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaH1Ru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaH1Uk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereMetaTitleUk($value)
 */
	class MetaTag extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $payment_id
 * @property int $delivery_id
 * @property int $status_id
 * @property int $total_products_count
 * @property float $total_order_amount
 * @property string $address_delivery
 * @property string $email
 * @property string $name
 * @property string $phone_number
 * @property int|null $order_number
 * @property string|null $comment
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereAddressDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereTotalOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereTotalProductsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\DatabaseModels\OrderStatus $status
 * @property string|null $checkout_point
 * @property string|null $np_delivery_type
 * @property string|null $country
 * @property string|null $np_city
 * @property string|null $np_city_ref
 * @property string|null $np_warehouse
 * @property string|null $np_warehouse_ref
 * @property string|null $a_street
 * @property string|null $a_land
 * @property string|null $a_city
 * @property string|null $post_index
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereACity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereALand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereAStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCheckoutPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereNpCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereNpCityRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereNpDeliveryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereNpWarehouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereNpWarehouseRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order wherePostIndex($value)
 * @property float|null $delivery_price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereDeliveryPrice($value)
 * @property int|null $checkout_point_id
 * @property int|null $delivery_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCheckoutPointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereDeliveryTypeId($value)
 * @property string|null $country_name
 * @property string|null $country_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Order whereCountryName($value)
 * @property-read \App\DatabaseModels\CheckoutPoint $checkoutPoint
 */
	class Order extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $size_id
 * @property int $product_count
 * @property float $price
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereProductCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class OrderProduct extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\OrderStatus
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property bool $is_default
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\OrderStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class OrderStatus extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Payment
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Payment extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\PictureSize
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $original
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $image_size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereImageSize($value)
 */
	class PictureSize extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Product
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property int $category_id
 * @property int|null $breadcrumb_category_id
 * @property string|null $description_ru
 * @property string|null $description_uk
 * @property int $priority
 * @property string|null $vendor_code
 * @property float|null $rating
 * @property int $number_of_views
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereBreadcrumbCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereNumberOfViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereVendorCode($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Image[] $images
 * @property int|null $group_id
 * @property int|null $color_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereGroupId($value)
 * @property-read \App\DatabaseModels\Color $color
 * @property-read \App\DatabaseModels\ProductGroup $product_group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Size[] $sizes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\ProductPrice[] $price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\ProductSize[] $product_sizes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Property[] $properties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Promotion[] $promotions
 * @property bool $is_visible
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereIsVisible($value)
 * @property-read \App\DatabaseModels\ProductCategory $product_category
 * @property int|null $meta_tag_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaTagId($value)
 * @property-read \App\DatabaseModels\MetaTag $meta_tag
 * @property string|null $meta_title_ru
 * @property string|null $meta_title_uk
 * @property string|null $meta_description_ru
 * @property string|null $meta_description_uk
 * @property string|null $meta_keywords_ru
 * @property string|null $meta_keywords_uk
 * @property string|null $meta_h1_ru
 * @property string|null $meta_h1_uk
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaH1Ru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaH1Uk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product whereMetaTitleUk($value)
 * @property string|null $picture_size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Product wherePictureSize($value)
 */
	class Product extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductCategory
 *
 * @property int $id
 * @property int $product_id
 * @property int $category_id
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductCategory whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductCategory whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProductCategory extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductGroup
 *
 * @property int $id
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductGroup whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\Product[] $products
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductGroup whereName($value)
 */
	class ProductGroup extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property int $image_id
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $priority
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductImage wherePriority($value)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductNotification
 *
 * @property int $id
 * @property int $product_id
 * @property int $size_id
 * @property int $count
 * @property string $email
 * @property string|null $name
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProductNotification extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductPrice
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_type_id
 * @property float $price
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereUserTypeId($value)
 * @mixin \Eloquent
 * @property float|null $old_price
 * @property int|null $discount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPrice whereOldPrice($value)
 */
	class ProductPrice extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductPromotion
 *
 * @property int $id
 * @property int $product_id
 * @property int $promotion_id
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion wherePromotionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductPromotion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProductPromotion extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductSize
 *
 * @property int $id
 * @property int $product_id
 * @property int $size_id
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductSize whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\ProductStock[] $stocks
 */
	class ProductSize extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\ProductStock
 *
 * @property int $id
 * @property int $product_size_id
 * @property int $user_type_id
 * @property int $stock
 * @property int $priority
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock whereProductSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\ProductStock whereUserTypeId($value)
 * @mixin \Eloquent
 */
	class ProductStock extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $payment_id
 * @property int|null $delivery_id
 * @property string|null $phone_number
 * @property string|null $address_delivery
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereAddressDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\DatabaseModels\Delivery $delivery
 * @property int|null $checkout_point_id
 * @property int|null $delivery_type_id
 * @property string|null $country
 * @property string|null $np_city
 * @property string|null $np_city_ref
 * @property string|null $np_warehouse
 * @property string|null $np_warehouse_ref
 * @property string|null $a_street
 * @property string|null $a_land
 * @property string|null $a_city
 * @property string|null $post_index
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereACity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereALand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereAStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereCheckoutPointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereDeliveryTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereNpCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereNpCityRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereNpWarehouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereNpWarehouseRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile wherePostIndex($value)
 * @property string|null $country_name
 * @property string|null $country_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Profile whereCountryName($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Promotion
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Promotion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Promotion extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Property
 *
 * @property int $id
 * @property int $product_id
 * @property int $property_name_id
 * @property int $property_value_id
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property wherePropertyNameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property wherePropertyValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\PropertyName[] $property_names
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\PropertyValue[] $property_values
 * @property int $is_visible
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Property whereIsVisible($value)
 */
	class Property extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\PropertyName
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_visible
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyName whereIsVisible($value)
 */
	class PropertyName extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\PropertyValue
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_visible
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PropertyValue whereIsVisible($value)
 */
	class PropertyValue extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Review
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $user_id
 * @property bool $is_moderated
 * @property string $review
 * @property string $name
 * @property string $email
 * @property float $rating
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereIsModerated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereUserId($value)
 * @mixin \Eloquent
 * @property int $is_deleted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Review whereIsDeleted($value)
 */
	class Review extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\Size
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Size whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Size extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\SocialLogin
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider_id
 * @property string $provider_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereUserId($value)
 * @mixin \Eloquent
 */
	class SocialLogin extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $user_type_id
 * @property string|null $remember_token
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereUserTypeId($value)
 * @mixin \Eloquent
 * @property bool $active
 * @property string|null $confirmation_token
 * @property string|null $new_email
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereNewEmail($value)
 */
	class User extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\UserType
 *
 * @property int $id
 * @property string $type_ru
 * @property string $type_uk
 * @property string $slug
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereTypeRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereTypeUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereIsDefault($value)
 */
	class UserType extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\WishList
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereUserId($value)
 * @mixin \Eloquent
 */
	class WishList extends \Eloquent {}
}

namespace App\DatabaseModels{
/**
 * App\DatabaseModels\WishListProduct
 *
 * @property int $id
 * @property int $wish_list_id
 * @property int $product_id
 * @property int $size_id
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishListProduct whereWishListId($value)
 * @mixin \Eloquent
 */
	class WishListProduct extends \Eloquent {}
}

