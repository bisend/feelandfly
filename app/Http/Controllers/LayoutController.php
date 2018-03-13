<?php

namespace App\Http\Controllers;

use App\DatabaseModels\Profile;
use App\DatabaseModels\UserType;
use App\DatabaseModels\WishList;
use App\Helpers\Languages;
use App\Services\ProfileService;
use function foo\func;
use Illuminate\Http\Request;
use Session;

/**
 * Class LayoutController
 * @package App\Http\Controllers
 */
class LayoutController extends Controller
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * LayoutController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * ajax method get user and fill some fields
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        $language = request('language');
        
        Languages::localizeApp($language);
        
        if (auth()->check())
        {
            $user = auth()->user();
            $userTypeId = $user->user_type_id;
            $profile = Profile::with([
                'delivery' => function ($query) use ($language) {
                    $query->select([
                        'id',
                        "name_$language as name",
                        'slug'
                    ]);
                }
            ])->whereUserId($user->id)->first();
            $wishList = WishList::whereUserId($user->id)->first();
            $wishListItems = $this->profileService->getWishListItems($wishList->id, $language, $userTypeId);
            $totalWishListCount = $this->profileService->getTotalWishListCount($wishListItems);
        }
        else
        {
            $user = null;
            $userType = UserType::whereIsDefault(true)->first();
            $userTypeId = $userType->id;
            $profile = null;
            $wishList = null;
            $wishListItems = [];
            $totalWishListCount = 0;
        }
            
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'profile' => $profile,
            'userTypeId' => $userTypeId,
            'wishList' => $wishList,
            'wishListItems' => $wishListItems,
            'totalWishListCount' => $totalWishListCount
        ]);
    }
}
