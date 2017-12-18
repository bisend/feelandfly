<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\WishList
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\WishList whereUserId($value)
 * @mixin \Eloquent
 */
class WishList extends Model
{
    protected $table = 'wish_lists';
}
