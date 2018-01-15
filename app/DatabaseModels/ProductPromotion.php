<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class ProductPromotion extends Model
{
    protected $table = 'products_promotions';
}
