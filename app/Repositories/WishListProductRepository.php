<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 18.12.2017
 * Time: 15:00
 */

namespace App\Repositories;

use App\DatabaseModels\WishListProduct;

/**
 * Class WishListProductRepository
 * @package App\Repositories
 */
class WishListProductRepository
{
    /**
     * save product to wish list
     * @param $wishListId
     * @param $productId
     * @param $sizeId
     */
    public function addToWishList($wishListId, $productId, $sizeId)
    {
        $wishListProduct = new WishListProduct();
        $wishListProduct->wish_list_id = $wishListId;
        $wishListProduct->product_id = $productId;
        $wishListProduct->size_id = $sizeId;
        $wishListProduct->save();
    }

    /**
     * delete product from wish list
     * @param $wishListProductId
     */
    public function deleteFromWishList($wishListProductId)
    {
        WishListProduct::whereId($wishListProductId)->delete();
    }

    /**
     * return wish list products
     * @param $wishListId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWishListProducts($wishListId)
    {
        return WishListProduct::whereWishListId($wishListId)->get();
    }
}