<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

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
class Property extends Model
{
    protected $table = 'properties';

    public function property_names()
    {
        return $this->hasMany(PropertyName::class, 'id', 'property_name_id');
    }

    public function property_values()
    {
        return $this->hasMany(PropertyValue::class, 'id', 'property_value_id');
    }
}
