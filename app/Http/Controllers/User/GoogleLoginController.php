<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\SocialLogin;
use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use Session;
use Socialite;

class GoogleLoginController extends LayoutController
{
    public function redirectToProvider($language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        Session::put('language', $language);

        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $userProvider = Socialite::driver('google')->user();

        $name = $userProvider->getName();
        $email = $userProvider->getEmail();
        $providerId = $userProvider->getId();

        $socialLogin = SocialLogin::whereProviderId($providerId)->first();
        
        if ($socialLogin)
        {
            $user = User::whereId($socialLogin->user_id)->first();

            auth()->login($user);

            if (Session::has('language'))
            {
                return redirect(url_home(Session::get('language')));
            }
            else
            {
                return redirect('/');
            }
        }

        if (!$socialLogin)
        {
            $user = User::whereEmail($email)->first();

            if (!$user)
            {
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->password = bcrypt(str_random(8));
                $user->user_type_id = 1;
                $user->active = true;
                $user->save();
            }

            $sLogin = new SocialLogin();
            $sLogin->user_id = $user->id;
            $sLogin->provider_id = $providerId;
            $sLogin->provider_name = 'google';
            $sLogin->save();

            auth()->login($user);

            if (Session::has('language'))
            {
                return redirect(url_home(Session::get('language')));
            }
            else
            {
                return redirect('/');
            }
        }

        if (Session::has('language'))
        {
            return redirect(url_home(Session::get('language')));
        }
        else
        {
            return redirect('/');
        }
        // $user->token;
    }
}
