<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class ChangePasswordController
 * @package App\Http\Controllers\Profile
 */
class ChangePasswordController extends LayoutController
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * ChangePasswordController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * method handles changing of user password
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $user = auth()->user();
        
        $oldPassword = request('oldPassword');

        if (\Hash::check($oldPassword, $user->password))
        {
            $this->profileService->changePassword($user->id, request('newPassword'));

            auth()->logout();

            auth()->login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'goodPass'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'badPass'
        ]);
    }
}
