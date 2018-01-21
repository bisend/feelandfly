<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class ProductCategory extends Model
{
    protected $table = 'product_category';

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}
