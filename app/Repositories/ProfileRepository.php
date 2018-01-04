<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.12.2017
 * Time: 13:46
 */

namespace App\Repositories;

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
     * return selected payment id
     * @param $model
     * @return int|mixed|null
     */
    public function getSelectedPaymentId($model)
    {
        $user = auth()->user();
        
        $profile = Profile::whereUserId($user->id)->first();
        
        return $profile->payment_id;
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

    /**
     * @param $model
     * @return mixed|null|string
     */
    public function getAddress($model)
    {
        $user = auth()->user();

        $profile = Profile::whereUserId($user->id)->first();

        return $profile->address_delivery;
    }

    /**
     * save selected payment and delivery
     * @param $paymentId
     * @param $deliveryId
     * @param $address
     */
    public function savePaymentDelivery($paymentId, $deliveryId, $address)
    {
        $user = auth()->user();

        $profile = Profile::whereUserId($user->id)->first();
        
        $profile->payment_id = $paymentId;
        
        $profile->delivery_id = $deliveryId;
        
        $profile->address_delivery = $address;
        
        $profile->save();
    }
}