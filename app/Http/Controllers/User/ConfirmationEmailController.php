<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\Profile;
use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Repositories\ProfileRepository;

class ConfirmationEmailController extends LayoutController
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
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

//        $this->wishListRepository->createWishList($user->id);

        return redirect(url_home($language));
    }
}
