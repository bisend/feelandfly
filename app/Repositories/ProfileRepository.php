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
    
    public function getSelectedPaymentId($model)
    {
        $user = auth()->user();
        
        $profile = Profile::whereUserId($user->id)->first();
        
        return $profile->payment_id;
    }
    
    public function getSelectedDeliveryId($model)
    {
        $user = auth()->user();
        
        $profile = Profile::whereUserId($user->id)->first();
        
        return $profile->delivery_id;
    }
    
    public function getAddress($model)
    {
        $user = auth()->user();

        $profile = Profile::whereUserId($user->id)->first();

        return $profile->address_delivery;
    }
    
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