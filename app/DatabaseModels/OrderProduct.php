<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class OrderProduct extends Model
{
    protected $table = 'order_products';
}
