<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class WishListProduct extends Model
{
    protected $table = 'wish_list_products';
}
