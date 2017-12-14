<?php

namespace App\Http\Controllers\Profile;

use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Mail\NewEmailConfirm;
use App\Services\ProfileService;
use App\ViewModels\PersonalInfoViewModel;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PersonalInfoController extends LayoutController
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

        $model = new PersonalInfoViewModel('personal-info', $language);
        
        $this->profileService->fill($model);
        
        return view('pages.personal-info', compact('model'));
    }

    public function savePersonalInfo()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $user = auth()->user();

        $this->profileService->saveUserName($user->id, request('name'));

        $this->profileService->saveProfilePhoneNumber($user->id, request('phone'));
        
        if ($this->profileService->checkIfEmailChanged($user->id, request('email')))
        {
            if (!$this->profileService->checkIfNewEmailValid(request('email')))
            {
                return response()->json([
                    'status' => 'error',
                    'isNewEmailValid' => false
                ]);
            }
            
            $this->profileService->saveNewEmail($user->id, request('email'));

            $confirmationToken = $user->confirmation_token;

            try {
                $confirmationUrl = url_new_email_confirmation($confirmationToken, request('language'));

                \Mail::to(request('email'))->send(new NewEmailConfirm($user, $confirmationUrl, request('language')));
            }
            catch (\Exception $e) {

                return response()->json([
                    'status' => 'error',
                    'failed' => 'server'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'emailChanged' => true
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function confirmNewEmail($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $user = User::whereConfirmationToken($confirmationToken)->first();

        if (!$user)
        {
            abort(404);
        }

        if ($user->new_email == null)
        {
            return redirect(url_home($language));
        }

        $user->email = $user->new_email;

        $user->new_email = null;

        $user->save();

        auth()->logout();

        auth()->login($user);

        return redirect(url_home($language));
    }
}
