<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\SocialLogin;
use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Mail\SocialEmailConfirm;
use App\Repositories\ProfileRepository;
use App\Repositories\WishListRepository;
use DB;
use Illuminate\Http\Request;
use Session;
use Socialite;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

class FacebookLoginController extends LayoutController
{
    protected $profileRepository;

    protected $wishListRepository;
    
    public function __construct(ProfileRepository $profileRepository, WishListRepository $wishListRepository)
    {
        $this->profileRepository = $profileRepository;

        $this->wishListRepository = $wishListRepository;
    }

    public function redirectToProvider($language = Languages::DEFAULT_LANGUAGE)
    {
        Session::put('previousSocialLoginUrl', url()->previous());
        
        Languages::localizeApp($language);
        
        Session::put('language', $language);
        
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $userProvider = Socialite::driver('facebook')->user();

        $name = $userProvider->getName();
        $email = $userProvider->getEmail();
        $providerId = $userProvider->getId();

        $socialLogin = SocialLogin::whereProviderId($providerId)->first();

        if ($socialLogin)
        {
            $user = User::whereId($socialLogin->user_id)->first();

            auth()->login($user);

            if (Session::has('previousSocialLoginUrl'))
            {
                return redirect(Session::get('previousSocialLoginUrl'));
            }

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
            if (!$email)
            {
                Session::put('social_email', [
                    'isEmail' => false,
                    'name' => $name,
                    'providerId' => $providerId,
                    'confirmationToken' => str_random(31) . $providerId
                ]);

                if (Session::has('previousSocialLoginUrl'))
                {
                    return redirect(Session::get('previousSocialLoginUrl'));
                }

                return redirect(url_home(Session::get('language')));
            }

            if ($email)
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
                    $confirmationToken = str_random(31) . $user->id;
                    $user->confirmation_token = $confirmationToken;
                    $user->save();

                    $sLogin = new SocialLogin();
                    $sLogin->user_id = $user->id;
                    $sLogin->provider_id = $providerId;
                    $sLogin->provider_name = 'facebook';
                    $sLogin->save();

                    auth()->login($user);

                    $this->profileRepository->createProfile($user);

                    $this->wishListRepository->createWishList($user->id);

                    if (Session::has('previousSocialLoginUrl'))
                    {
                        return redirect(Session::get('previousSocialLoginUrl'));
                    }

                    if (Session::has('language'))
                    {
                        return redirect(url_home(Session::get('language')));
                    }
                    else
                    {
                        return redirect('/');
                    }
                }

                if ($user)
                {
                    $sLogin = new SocialLogin();
                    $sLogin->user_id = $user->id;
                    $sLogin->provider_id = $providerId;
                    $sLogin->provider_name = 'facebook';
                    $sLogin->save();

                    auth()->login($user);

                    if (Session::has('previousSocialLoginUrl'))
                    {
                        return redirect(Session::get('previousSocialLoginUrl'));
                    }

                    if (Session::has('language'))
                    {
                        return redirect(url_home(Session::get('language')));
                    }
                    else
                    {
                        return redirect('/');
                    }
                }
            }
        }

        if (Session::has('previousSocialLoginUrl'))
        {
            return redirect(Session::get('previousSocialLoginUrl'));
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

    public function socialEmailHandler(Request $request)
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:191'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'email'
            ]);
        }
        
        try
        {
            $confirmationToken = Session::get('social_email.confirmationToken');
            
            Session::put('social_email.email', request('email'));
            
            $confirmationUrl = url_social_email_confirmation($confirmationToken, request('language'));

            \Mail::to(request('email'))->send(new SocialEmailConfirm($confirmationUrl, request('language')));
        }
        catch (\Exception $e)
        {
            \Debugbar::info($e->getMessage());
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function confirmSocialEmail($confirmationToken, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!Session::has('social_email'))
        {
            if (Session::has('previousSocialLoginUrl'))
            {
                return redirect(Session::get('previousSocialLoginUrl'));
            }

            if (Session::has('language'))
            {
                return redirect(url_home(Session::get('language')));
            }
            else
            {
                return redirect('/');
            }
        }

        DB::beginTransaction();

        try
        {
            $userProvider = Session::pull('social_email');

            if ($confirmationToken == $userProvider['confirmationToken'])
            {
                $user = User::whereEmail($userProvider['email'])->first();

                if (!$user)
                {
                    $user = new User();
                    $user->name = $userProvider['name'];
                    $user->email = $userProvider['email'];
                    $user->password = bcrypt(str_random(8));
                    $user->user_type_id = 1;
                    $user->active = true;
                    $user->save();
                    $confirmationToken = str_random(31) . $user->id;
                    $user->confirmation_token = $confirmationToken;
                    $user->save();

                    $this->profileRepository->createProfile($user);

                    $this->wishListRepository->createWishList($user->id);
                }

                $sLogin = new SocialLogin();
                $sLogin->user_id = $user->id;
                $sLogin->provider_id = $userProvider['providerId'];
                $sLogin->provider_name = 'facebook';
                $sLogin->save();

                auth()->login($user);
            }
            else
            {
                Session::put('social_email', $userProvider);
            }

        }
        catch (\Exception $e)
        {
            Session::put('social_email', $userProvider);

            DB::rollBack();
        }

        DB::commit();

        if (Session::has('previousSocialLoginUrl'))
        {
            return redirect(Session::get('previousSocialLoginUrl'));
        }

        if (Session::has('language'))
        {
            return redirect(url_home(Session::get('language')));
        }
        else
        {
            return redirect('/');
        }
    }
}
