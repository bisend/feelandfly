<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\User;
use App\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

/**
 * Class LoginController
 * @package App\Http\Controllers\User
 */
class LoginController extends LayoutController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'email'
            ]);
        }

        $isActive = User::whereEmail(request('email'))->whereActive(1)->count();

        if (!$isActive)
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'active'
            ]);
        }

        if (!auth()->guard()->attempt([
            'email' => request('email'),
            'password' => request('password'),
            'active' => 1
        ], request('remember')))
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'password'
            ]);
        }
        
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    public function logout()
    {
//        if (!auth()->check())
//        {
//            return redirect('/');
//        }

        auth()->logout();

        return redirect(url()->previous());
    }
}
