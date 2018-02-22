<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\CooperationService;
use App\Services\ProfileService;
use App\ViewModels\CooperationViewModel;

class CooperationController extends LayoutController
{
    private $cooperationService;

    public function __construct(ProfileService $profileService, CooperationService $cooperationService)
    {
        parent::__construct($profileService);

        $this->cooperationService = $cooperationService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CooperationViewModel('cooperation', $language);

        $this->cooperationService->fill($model);

        \Debugbar::info($model);

        return view('pages.cooperation', compact('model'));
    }
}
