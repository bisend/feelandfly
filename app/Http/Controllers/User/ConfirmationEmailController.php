<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\Profile;
use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Repositories\ProfileRepository;
use App\Repositories\WishListRepository;

/**
 * Class ConfirmationEmailController
 * @package App\Http\Controllers\User
 */
class ConfirmationEmailController extends LayoutController
{
    /**
     * @var ProfileRepository
     */
    protected $profileRepository;

    /**
     * @var WishListRepository
     */
    protected $wishListRepository;

    /**
     * ConfirmationEmailController constructor.
     * @param ProfileRepository $profileRepository
     * @param WishListRepository $wishListRepository
     */
    public function __construct(ProfileRepository $profileRepository, WishListRepository $wishListRepository)
    {
        $this->profileRepository = $profileRepository;
        
        $this->wishListRepository = $wishListRepository;
    }

    /**
     * method handles confirmation of user email when simple registration
     * @param null $confirmationToken
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
