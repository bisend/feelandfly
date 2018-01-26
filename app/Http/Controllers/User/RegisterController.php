<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\Profile;
use App\DatabaseModels\User;
use App\DatabaseModels\UserType;
use App\Http\Controllers\LayoutController;
use App\Mail\EmailConfirm;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

/**
 * Class RegisterController
 * @package App\Http\Controllers\User
 */
class RegisterController extends LayoutController
{
    /**
     * registering user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $language = request('language');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'email'
            ]);
        }

        DB::beginTransaction();

        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $userType = UserType::whereIsDefault(true)->first();
        $user->user_type_id = $userType->id;
        $user->save();
        $confirmationToken = str_random(31) . $user->id;
        $user->confirmation_token = $confirmationToken;
        $user->save();
        
        try {
            $confirmationUrl = url_confirmation($confirmationToken, $language);

            \Mail::to($user)->send(new EmailConfirm($user, $confirmationUrl, $language));
        }
        catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'failed' => 'server'
            ]);
        }

        DB::commit();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
