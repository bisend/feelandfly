<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use App\ViewModels\WishListViewModel;

class WishListController extends LayoutController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!auth()->check())
        {
            return redirect(url_home($language));
        }

        $model = new WishListViewModel('wish-list', $language, 1);

        $this->profileService->fill($model);

        return view('pages.wish-list', compact('model'));
    }

    public function addToWishList()
    {
        $wishListId = request('wishListId');
        $productId = request('productId');
        $sizeId = request('sizeId');
        $language = request('language');
        $userTypeId = request('userTypeId');

        $this->profileService->addToWishList($wishListId, $productId, $sizeId);
        
        $wishListItems = $this->profileService->getWishListItems($wishListId, $language, $userTypeId);
        
        \Debugbar::info(request()->all());
        
        return response()->json([
            'status' => 'success',
            'wishListItems' => $wishListItems
        ]);
    }

    public function deleteFromWishList()
    {
        $wishListProductId = request('wishListProductId');
        $wishListId = request('wishListId');
        $language = request('language');
        $userTypeId = request('userTypeId');
        
        $this->profileService->deleteFromWishList($wishListProductId);

        $wishListItems = $this->profileService->getWishListItems($wishListId, $language, $userTypeId);
        
        return response()->json([
            'status' => 'success',
            'wishListItems' => $wishListItems
        ]);
    }
}
