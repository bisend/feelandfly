<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class Order extends Model
{
    protected $table = 'orders';

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status_id');
    }
}
