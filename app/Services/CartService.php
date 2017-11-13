<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 03.11.2017
 * Time: 14:29
 */

namespace App\Services;

use App\Repositories\ProductRepository;
use Session;

class CartService
{
    protected $productRepository;

    protected $sessionKey = 'cart';

    public $cart = [];

    public $cartProducts = [];

    public $totalCount = 0;

    public $totalAmount = 0;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function fill($language, $userTypeId)
    {
        $this->fillCart();
        
        $this->fillCartProducts($language, $userTypeId);

//        $this->fillTotalCount();
        
//        $this->filltotalAmount();
    }

    public function fillCart()
    {
        if (Session::has($this->sessionKey))
        {
            $this->cart = Session::get($this->sessionKey);
        }
    }

    public function fillTotalCount()
    {
        if (Session::has($this->sessionKey))
        {
            $cart = Session::get($this->sessionKey);

            foreach ($cart as $cartItem)
            {
                $this->totalCount += $cartItem['count'];
            }
        }
    }
    
    public function fillCartProducts($language, $userTypeId)
    {
        if (Session::has('cart'))
        {
//            $cart = Session::get('cart');

//            $productIds = [];
//
//            foreach ($cart as $cartItem)
//            {
//                $productIds[] = $cartItem['productId'];
//            }
//
//            $cartProducts = $this->productRepository->getCartProducts($productIds, $language, $userTypeId);
//
//            foreach ($cart as $cartItem)
//            {
//                foreach ($cartProducts as $cartProduct)
//                {
//                    if ($cartItem['productId'] == $cartProduct->id)
//                    {
//                        $newCartProduct = $cartProduct;
//                        $newCartProduct->count = $cartItem['count'];
//                        $newCartProduct->sizeId = $cartItem['sizeId'];
//                        $this->cartProducts[] = $newCartProduct;
//
//                        $this->totalCount += $cartItem['count'];
//                        $this->totalAmount += ($newCartProduct->price[0]->price * $cartItem['count']);
//                    }
//                }
//            }



//            foreach ($cart as $cartItem)
//            {
//                $product = $this->productRepository->getProductById($cartItem['productId'], $language, $userTypeId);
//                $product->sizeId = $cartItem['sizeId'];
//                $product->count = $cartItem['count'];
//                $this->cartProducts[] = $product;
//
//                $this->totalCount += $cartItem['count'];
//                $this->totalAmount += ($product->price[0]->price * $cartItem['count']);
//            }


            $productIds = [];

            foreach ($this->cart as $cartItem)
            {
                $productIds[] = $cartItem['productId'];
            }

            $cartProducts = $this->productRepository->getCartProducts($productIds, $language, $userTypeId);

            $newCart = [];

            foreach ($this->cart as $cartItem)
            {
                foreach ($cartProducts as $cartProduct)
                {
                    if ($cartItem['productId'] == $cartProduct->id)
                    {
                        $cartItem['product'] = $cartProduct;
                        $newCart[] = $cartItem;
                        $this->totalCount += $cartItem['count'];
                        $this->totalAmount += ($cartItem['count'] * $cartProduct->price[0]->price) ;
                    }
                }
            }
            $this->cart = $newCart;
        }
        \Debugbar::info($this->cart);
    }

    public function addToCart($productId, $sizeId, $count)
    {
        $cart = Session::pull($this->sessionKey);

        $isItemInCart = false;

        $item = [
            'productId' => (int) $productId,
            'sizeId' => (int) $sizeId,
            'count' => (int) $count
        ];

        if (count($cart) != 0)
        {
            foreach ($cart as $cartItem)
            {
                if ($cartItem['productId'] == $item['productId'] && $cartItem['sizeId'] == $item['sizeId'])
                {
                    $isItemInCart = true;
                }
            }
        }

        if (!$isItemInCart)
        {
            $cart[] = $item;
        }

        Session::put($this->sessionKey, $cart);
        
        $this->cart = Session::get($this->sessionKey);
    }

    public function updateCart($productId, $sizeId, $count)
    {
        $cart = Session::pull($this->sessionKey);
        
        $item = [
            'productId' => (int) $productId,
            'sizeId' => (int) $sizeId,
            'count' => (int) $count
        ];

        if (count($cart) != 0)
        {
            $newCart = [];
            
            foreach ($cart as $cartItem)
            {
                if ($cartItem['productId'] == $item['productId'] && $cartItem['sizeId'] == $item['sizeId'])
                {
                    $cartItem['count'] = $item['count'];
                }
                $newCart[] = $cartItem;
            }
            \Debugbar::info($cart, $newCart);
        }

        Session::put($this->sessionKey, $newCart);

        $this->cart = Session::get($this->sessionKey);
    }

    public function deleteFromCart($productId, $sizeId, $language, $userTypeId)
    {
        $sessionCart = Session::pull($this->sessionKey);

        $newSessionCart = [];

        \Debugbar::info($sessionCart);

        foreach ($sessionCart as $sessionCartItem)
        {
            \Debugbar::info($sessionCartItem['productId'], $sessionCartItem['sizeId']);
            if ($sessionCartItem['productId'] == $productId && $sessionCartItem['sizeId'] == $sizeId)
            {

            }
            else
            {
                \Debugbar::info($sessionCartItem);
                $newSessionCart[] = $sessionCartItem;
            }
        }

        \Debugbar::info($newSessionCart);

        Session::put($this->sessionKey, $newSessionCart);

        $this->fill($language, $userTypeId);
    }
}