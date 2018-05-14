<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class ProductNotification extends Model
{
    protected $table = 'product_notifications';
}
