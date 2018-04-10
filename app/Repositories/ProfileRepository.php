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

    public function getProfile($model)
    {
        $user = auth()->user();

        return Profile::whereUserId($user->id)->first();
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
//        $user = auth()->user();
        
//        $profile = Profile::whereUserId($user->id)->first();
        
//        return $profile->delivery_id;
        return $model->profile->delivery_id;
    }

    public function getSelectedDeliveryTypeId($model)
    {
//        $user = auth()->user();

//        $profile = Profile::whereUserId($user->id)->first();

//        return $profile->delivery_type_id;

        return $model->profile->delivery_type_id;
    }

    public function getSelectedCountryCode($model)
    {
        return $model->profile->country_code;
    }

    public function getSelectedCheckoutPointId($model)
    {
        return $model->profile->checkout_point_id;
    }

    public function getSelectedCityRef($model)
    {
        return $model->profile->np_city_ref;
    }

    public function getSelectedWarehouseRef($model)
    {
        return $model->profile->np_warehouse_ref;
    }

    public function getSelectedStreet($model)
    {
        return $model->profile->a_street;
    }

    public function getSelectedLand($model)
    {
        return $model->profile->a_land;
    }

    public function getSelectedCity($model)
    {
        return $model->profile->a_city;
    }

    public function getSelectedIndex($model)
    {
        return $model->profile->post_index;
    }

    /**
     * save delivery
     * @param $deliveryId
     * @param $deliveryTypeId
     * @param $countryName
     * @param $countryCode
     * @param $city
     * @param $cityRef
     * @param $warehouse
     * @param $warehouseRef
     * @param $aStreet
     * @param $aLand
     * @param $aCity
     * @param $postIndex
     */
    public function savePaymentDelivery($deliveryId, $deliveryTypeId, $checkoutPointId, $countryName,
                                        $countryCode, $city, $cityRef, $warehouse, $warehouseRef, $aStreet, $aLand, $aCity, $postIndex)
    {
        $user = auth()->user();

        $profile = Profile::whereUserId($user->id)->first();
        
        $profile->delivery_id = $deliveryId;
        $profile->delivery_type_id = $deliveryTypeId;
        $profile->checkout_point_id = $checkoutPointId;
        $profile->country_name = $countryName;
        $profile->country_code = $countryCode;
        $profile->np_city = $city;
        $profile->np_city_ref = $cityRef;
        $profile->np_warehouse = $warehouse;
        $profile->np_warehouse_ref = $warehouseRef;
        $profile->a_street = $aStreet;
        $profile->a_land = $aLand;
        $profile->a_city = $aCity;
        $profile->post_index = $postIndex;

        $profile->save();
    }
}