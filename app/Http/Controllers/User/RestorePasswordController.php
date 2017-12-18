<?php

namespace App\Http\Controllers\User;

use App\DatabaseModels\User;
use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Mail\RestorePassword;
use DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RestorePasswordController extends LayoutController
{
    public function restore()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $language = request('language');

        Languages::localizeApp($language);

        $user = User::whereEmail(request('email'))->first();

        if (!$user)
        {
            return response()->json([
                'status' => 'error',
                'failed' => 'email'
            ]);
        }

        $newPassword = str_random(10);

        DB::beginTransaction();

        $user->password = bcrypt($newPassword);

        $user->save();

        try {
            \Mail::to($user)->send(new RestorePassword($user, $newPassword, $language));
        }
        catch (\Exception $e)
        {
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
