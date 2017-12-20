<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\ErrorService;
use App\Services\ProfileService;
use App\ViewModels\ErrorViewModel;
use Illuminate\Http\Request;

class ErrorController extends LayoutController
{
    protected $errorService;

    public function __construct(ProfileService $profileService, ErrorService $errorService)
    {
        parent::__construct($profileService);

        $this->errorService = $errorService;
    }

    public function index($error, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new ErrorViewModel('error', $language, $error);

        $this->errorService->fill($model);

        return view("errors.$error", compact('model'));
    }
}
