<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.12.2017
 * Time: 13:46
 */

namespace App\Repositories;


use App\DatabaseModels\Profile;

class ProfileRepository
{
    public function createProfile($user)
    {
        $profile = new Profile();

        $profile->user_id = $user->id;

        $profile->save();
    }
    
    public function saveProfilePhoneNumber($userId, $phone)
    {
        $profile = Profile::whereUserId($userId)->first();
        
        $profile->phone_number = $phone;
        
        $profile->save();
    }
}