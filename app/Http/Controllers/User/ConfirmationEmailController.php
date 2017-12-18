<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\Profile;
use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Repositories\ProfileRepository;
use App\Repositories\WishListRepository;

class ConfirmationEmailController extends LayoutController
{
    protected $profileRepository;
    
    protected $wishListRepository;

    public function __construct(ProfileRepository $profileRepository, WishListRepository $wishListRepository)
    {
        $this->profileRepository = $profileRepository;
        
        $this->wishListRepository = $wishListRepository;
    }

    public function confirm($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $user = User::whereConfirmationToken($confirmationToken)->first();

        if (!$user)
        {
            abort(404);
        }

        if ($user->active == true)
        {
            return redirect(url_home($language));
        }

        $user->active = true;

        $user->save();
        
        auth()->login($user);

        $this->profileRepository->createProfile($user);

        $this->wishListRepository->createWishList($user->id);

        return redirect(url_home($language));
    }
}
