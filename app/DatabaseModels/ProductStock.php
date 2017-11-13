<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class ProductStock extends Model
{
    protected $table = 'product_stocks';
}
