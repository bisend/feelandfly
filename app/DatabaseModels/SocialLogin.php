<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\SocialLogin
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider_id
 * @property string $provider_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\SocialLogin whereUserId($value)
 * @mixin \Eloquent
 */
class SocialLogin extends Model
{
    protected $table = 'social_logins';
}
