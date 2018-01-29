<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\LookBookService;
use App\Services\ProfileService;
use App\ViewModels\LookBookViewModel;
use Illuminate\Http\Request;

class LookBookController extends LayoutController
{
    protected $lookBookService;

    public function __construct(ProfileService $profileService, LookBookService $lookBookService)
    {
        parent::__construct($profileService);

        $this->lookBookService = $lookBookService;
    }
    
    public function showAllLookBook($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new LookBookViewModel('lookbook-all', $language);

        $this->lookBookService->fill($model);
        
        return view('pages.lookbook-all', compact('model'));
    }
}
