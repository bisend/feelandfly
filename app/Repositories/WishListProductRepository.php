<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 18.12.2017
 * Time: 15:00
 */

namespace App\Repositories;


use App\DatabaseModels\WishListProduct;

class WishListProductRepository
{
    public function addToWishList($wishListId, $productId, $sizeId)
    {
        $wishListProduct = new WishListProduct();
        $wishListProduct->wish_list_id = $wishListId;
        $wishListProduct->product_id = $productId;
        $wishListProduct->size_id = $sizeId;
        $wishListProduct->save();
    }

    public function deleteFromWishList($wishListProductId)
    {
        WishListProduct::whereId($wishListProductId)->delete();
    }
    
    public function getWishListProducts($wishListId)
    {
        return WishListProduct::whereWishListId($wishListId)->get();
    }
}