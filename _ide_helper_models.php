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
 */
	class Category extends \Eloquent {}
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
 */
	class Delivery extends \Eloquent {}
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
 */
	class Image extends \Eloquent {}
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
 */
	class Product extends \Eloquent {}
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
 */
	class ProductPrice extends \Eloquent {}
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
 */
	class Profile extends \Eloquent {}
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
 */
	class PropertyValue extends \Eloquent {}
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
 */
	class UserType extends \Eloquent {}
}
