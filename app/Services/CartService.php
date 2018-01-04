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

/**
 * Class CartService
 * @package App\Services
 */
class CartService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var string
     */
    protected $sessionKey = 'cart';

    /**
     * @var array
     */
    public $cart = [];

    /**
     * @var int
     */
    public $totalCount = 0;

    /**
     * @var int
     */
    public $totalAmount = 0;

    /**
     * CartService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param $language
     * @param $userTypeId
     */
    public function fill($language, $userTypeId)
    {
        $this->fillCart();
        
        $this->fillCartProducts($language, $userTypeId);
    }

    /**
     * fill $cart with data from session
     */
    public function fillCart()
    {
        if (Session::has($this->sessionKey))
        {
            $this->cart = Session::get($this->sessionKey);
        }
    }

    /**
     * fill cart with products
     * @param $language
     * @param $userTypeId
     */
    public function fillCartProducts($language, $userTypeId)
    {
        if (Session::has('cart'))
        {
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
    }

    /**
     * add to cart
     * @param $productId
     * @param $sizeId
     * @param $count
     */
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

    /**
     * update cart
     * @param $productId
     * @param $sizeId
     * @param $count
     */
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
        }

        Session::put($this->sessionKey, $newCart);

        $this->cart = Session::get($this->sessionKey);
    }

    /**
     * delete from cart
     * @param $productId
     * @param $sizeId
     * @param $language
     * @param $userTypeId
     */
    public function deleteFromCart($productId, $sizeId, $language, $userTypeId)
    {
        $sessionCart = Session::pull($this->sessionKey);

        $newSessionCart = [];

        foreach ($sessionCart as $sessionCartItem)
        {
            if ($sessionCartItem['productId'] == $productId && $sessionCartItem['sizeId'] == $sizeId)
            {

            }
            else
            {
                $newSessionCart[] = $sessionCartItem;
            }
        }

        if (count($newSessionCart) > 0)
        {
            Session::put($this->sessionKey, $newSessionCart);
        }

        $this->fill($language, $userTypeId);
    }

    /**
     * clear cart
     */
    public function clearCart()
    {
        if (Session::has('cart'))
        {
            Session::remove('cart');
        }
    }
}