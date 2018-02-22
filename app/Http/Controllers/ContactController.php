<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\ContactService;
use App\Services\ProfileService;
use App\ViewModels\ContactViewModel;

class ContactController extends LayoutController
{
    private $contactService;

    public function __construct(ProfileService $profileService, ContactService $contactService)
    {
        parent::__construct($profileService);

        $this->contactService = $contactService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new ContactViewModel('contact', $language);

        $this->contactService->fill($model);

        \Debugbar::info($model);

        return view('pages.contact', compact('model'));
    }
}
