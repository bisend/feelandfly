<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\UserType
 *
 * @property int $id
 * @property string $type_ru
 * @property string $type_uk
 * @property string $slug
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereTypeRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereTypeUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\UserType whereIsDefault($value)
 */
class UserType extends Model
{
    protected $table = 'user_types';
}
