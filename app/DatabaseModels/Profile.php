<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class Profile extends Model
{
    protected $table = 'profiles';

    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'id', 'delivery_id');
    }
}
