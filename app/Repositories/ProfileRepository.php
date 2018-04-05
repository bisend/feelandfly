<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.12.2017
 * Time: 13:46
 */

namespace App\Repositories;

use App\DatabaseModels\Delivery;
use App\DatabaseModels\Profile;

/**
 * Class ProfileRepository
 * @package App\Repositories
 */
class ProfileRepository
{
    /**
     * save new profile
     * @param $user
     */
    public function createProfile($user)
    {
        $profile = new Profile();

        $profile->user_id = $user->id;

        $profile->save();
    }

    /**
     * save phone number
     * @param $userId
     * @param $phone
     */
    public function saveProfilePhoneNumber($userId, $phone)
    {
        $profile = Profile::whereUserId($userId)->first();
        
        $profile->phone_number = $phone;
        
        $profile->save();
    }

    /**
     * return selected delivery id
     * @param $model
     * @return int|mixed|null
     */
    public function getSelectedDeliveryId($model)
    {
        $user = auth()->user();
        
        $profile = Profile::whereUserId($user->id)->first();
        
        return $profile->delivery_id;
    }

    public function getSelectedDeliveryTypeId($model)
    {
        $user = auth()->user();

        $profile = Profile::whereUserId($user->id)->first();

        return $profile->delivery_type_id;
    }

    /**
     * save selected delivery
     * @param $deliveryId
     * @param $deliveryTypeId
     */
    public function savePaymentDelivery($deliveryId, $deliveryTypeId)
    {
        $user = auth()->user();

        $profile = Profile::whereUserId($user->id)->first();
        
        $profile->delivery_id = $deliveryId;
        $profile->delivery_type_id = $deliveryTypeId;
        
        $profile->save();
    }
}