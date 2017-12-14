<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\Payment
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $slug
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    protected $table = 'payments';
}
