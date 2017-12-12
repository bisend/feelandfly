<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use Illuminate\Http\Request;
use Session;

/**
 * Class LayoutController
 * @package App\Http\Controllers
 */
class LayoutController extends Controller
{
    public function __construct()
    {
//        if (Session::has('language'))
//        {
//            Session::remove('language');
//        }
    }

    public function getUser()
    {
        $language = request('language');
        
        Languages::localizeApp($language);
        
        if (auth()->check())
        {
            $user = auth()->user();
            $userTypeId = $user->user_type_id;
        }
        else
        {
            $user = null;
            $userTypeId = 1;
        }
            
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'userTypeId' => $userTypeId
        ]);
    }
}
