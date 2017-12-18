<?php

namespace App\Http\Controllers;

use App\DatabaseModels\Profile;
use App\DatabaseModels\WishList;
use App\Helpers\Languages;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Session;

/**
 * Class LayoutController
 * @package App\Http\Controllers
 */
class LayoutController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function getUser()
    {
        $language = request('language');
        
        Languages::localizeApp($language);
        
        if (auth()->check())
        {
            $user = auth()->user();
            $userTypeId = $user->user_type_id;
            $profile = Profile::whereUserId($user->id)->first();
            $wishList = WishList::whereUserId($user->id)->first();

            $wishListItems = $this->profileService->getWishListItems($wishList->id, $language, $userTypeId);;
        }
        else
        {
            $user = null;
            $userTypeId = 1;
            $profile = null;
            $wishList = null;
            $wishListItems = [];
        }
            
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'profile' => $profile,
            'userTypeId' => $userTypeId,
            'wishList' => $wishList,
            'wishListItems' => $wishListItems
        ]);
    }
}
