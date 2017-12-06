<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\DatabaseModels\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $user_type_id
 * @property string|null $remember_token
 * @property int $priority
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereUserTypeId($value)
 * @mixin \Eloquent
 * @property bool $active
 * @property string|null $confirmation_token
 * @property string|null $new_email
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\User whereNewEmail($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
