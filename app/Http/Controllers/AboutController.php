<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\AboutService;
use App\Services\ProfileService;
use App\ViewModels\AboutViewModel;

class AboutController extends LayoutController
{
    private $aboutService;

    public function __construct(ProfileService $profileService, AboutService $aboutService)
    {
        parent::__construct($profileService);

        $this->aboutService = $aboutService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new AboutViewModel('about', $language);

        $this->aboutService->fill($model);

        \Debugbar::info($model);

        return view('pages.about', compact('model'));
    }
}
