<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 18.12.2017
 * Time: 10:51
 */

namespace App\Repositories;

use App\DatabaseModels\WishList;

/**
 * Class WishListRepository
 * @package App\Repositories
 */
class WishListRepository
{
    /**
     * save new wish list
     * @param $userId
     */
    public function createWishList($userId)
    {
        $wishList = new WishList();
        
        $wishList->user_id = $userId;

        $wishList->save();
    }

    /**
     * return wish list
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getWishList($userId)
    {
        return WishList::whereUserId($userId)->first();
    }
}