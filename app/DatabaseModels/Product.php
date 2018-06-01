<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class Product extends Model
{
    protected $table = 'products';

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_images');
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function product_group()
    {
        return $this->hasOne(ProductGroup::class, 'id', 'group_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }
    
    public function price()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }
    
    public function product_sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'product_id', 'id');
    }
    
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'products_promotions');
    }

    public function meta_tag()
    {
        return $this->hasOne(MetaTag::class, 'id', 'meta_tag_id');
    }
}
