<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class CartController extends LayoutController
{
    /**
     * @var CartService
     */
    protected $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * init cart on page load
     * @return \Illuminate\Http\JsonResponse
     */
    public function initCart()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }
        
        $language = request('language');

        $userTypeId = request('userTypeId');

        Languages::localizeApp($language);

        $this->cartService->fill($language, $userTypeId);
        
        return response()->json([
            'status' => 'success',
            'cart' => $this->cartService->cart,
            'totalCount' => $this->cartService->totalCount,
            'totalAmount' => $this->cartService->totalAmount
        ]);
    }

    /**
     * method handles adding product to cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $productId = request('productId');

        $sizeId = request('sizeId');

        $count = request('count');

        $language = request('language');

        $userTypeId = request('userTypeId');

        Languages::localizeApp($language);

        $this->cartService->addToCart($productId, $sizeId, $count);
        
        $this->cartService->fill($language, $userTypeId);

        return response()->json([
            'status' => 'success',
            'cart' => $this->cartService->cart,
            'totalCount' => $this->cartService->totalCount,
            'totalAmount' => $this->cartService->totalAmount
        ]);
    }

    /**
     * method handles updating cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $productId = request('productId');

        $sizeId = request('sizeId');

        $count = request('count');

        $language = request('language');
        
        $userTypeId = request('userTypeId');

        Languages::localizeApp($language);

        $this->cartService->updateCart($productId, $sizeId, $count);
        
        $this->cartService->fill($language, $userTypeId);

        return response()->json([
            'status' => 'success',
            'cart' => $this->cartService->cart,
            'totalCount' => $this->cartService->totalCount,
            'totalAmount' => $this->cartService->totalAmount
        ]);
    }

    /**
     * method handles deleting product from cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFromCart()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $productId = request('productId');

        $sizeId = request('sizeId');

        $language = request('language');

        $userTypeId = request('userTypeId');
        
        $this->cartService->deleteFromCart($productId, $sizeId, $language, $userTypeId);
        
        return response()->json([
            'status' => 'success',
            'cart' => $this->cartService->cart,
            'totalCount' => $this->cartService->totalCount,
            'totalAmount' => $this->cartService->totalAmount
        ]);
    }
}
