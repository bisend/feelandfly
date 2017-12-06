<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;

class ConfirmationEmailController extends LayoutController
{
    
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

//        $this->profileRepository->createProfile($user->id);
//
//        $this->wishListRepository->createWishList($user->id);

        return redirect(url_home($language));
    }
}
