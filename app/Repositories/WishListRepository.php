<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 18.12.2017
 * Time: 10:51
 */

namespace App\Repositories;

use App\DatabaseModels\WishList;

class WishListRepository
{
    public function createWishList($userId)
    {
        $wishList = new WishList();
        
        $wishList->user_id = $userId;

        $wishList->save();
    }

    public function getWishList($userId)
    {
        return WishList::whereUserId($userId)->first();
    }
}