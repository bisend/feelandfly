<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\SocialLogin;
use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Repositories\ProfileRepository;
use DB;
use Illuminate\Http\Request;
use Session;
use Socialite;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

class FacebookLoginController extends LayoutController
{
    protected $profileRepository;
    
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function redirectToProvider($language = Languages::DEFAULT_LANGUAGE)
    {
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
                    'providerId' => $providerId
                ]);

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

                    $this->profileRepository->createProfile($user);

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
            'email' => 'required|string|max:191|unique:users,email'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'email'
            ]);
        }

        DB::beginTransaction();

        $userProvider = Session::pull('social_email');

        try
        {
            $user = new User();
            $user->name = $userProvider['name'];
            $user->email = request('email');
            $user->password = bcrypt(str_random(8));
            $user->user_type_id = 1;
            $user->active = true;
            $user->save();
            $confirmationToken = str_random(31) . $user->id;
            $user->confirmation_token = $confirmationToken;
            $user->save();
            
            $sLogin = new SocialLogin();
            $sLogin->user_id = $user->id;
            $sLogin->provider_id = $userProvider['providerId'];
            $sLogin->provider_name = 'facebook';
            $sLogin->save();
        }
        catch (\Exception $e)
        {
            Session::put('social_email', $userProvider);

            DB::rollBack();
        }

        DB::commit();

        auth()->login($user);
        
        $this->profileRepository->createProfile($user);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
