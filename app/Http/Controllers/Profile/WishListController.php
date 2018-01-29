<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use App\ViewModels\WishListViewModel;

/**
 * Class WishListController
 * @package App\Http\Controllers\Profile
 */
class WishListController extends LayoutController
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * WishListController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * wish list page in profile
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!auth()->check())
        {
            return redirect(url_home($language));
        }

        $model = new WishListViewModel('profile-wish-list', $language, 1);

        $this->profileService->fill($model);

        return view('pages.wish-list', compact('model'));
    }

    /**
     * method handles adding product to wish list
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToWishList()
    {
        $wishListId = request('wishListId');
        
        $productId = request('productId');
        
        $sizeId = request('sizeId');
        
        $language = request('language');
        
        $userTypeId = request('userTypeId');

        $this->profileService->addToWishList($wishListId, $productId, $sizeId);
        
        $wishListItems = $this->profileService->getWishListItems($wishListId, $language, $userTypeId);
        
        $totalWishListCount = $this->profileService->getTotalWishListCount($wishListItems);
        
        return response()->json([
            'status' => 'success',
            'wishListItems' => $wishListItems,
            'totalWishListCount' => $totalWishListCount
        ]);
    }

    /**
     * method handles deleting product from wish list
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFromWishList()
    {
        $wishListProductId = request('wishListProductId');
        
        $wishListId = request('wishListId');
        
        $language = request('language');
        
        $userTypeId = request('userTypeId');
        
        $this->profileService->deleteFromWishList($wishListProductId);

        $wishListItems = $this->profileService->getWishListItems($wishListId, $language, $userTypeId);
        
        $totalWishListCount = $this->profileService->getTotalWishListCount($wishListItems);
        
        return response()->json([
            'status' => 'success',
            'wishListItems' => $wishListItems,
            'totalWishListCount' => $totalWishListCount
        ]);
    }
}
