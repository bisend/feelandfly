<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\HomeService;
use App\ViewModels\HomeViewModel;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends LayoutController
{
    /**
     * @var HomeService
     */
    protected $homeService;

    /**
     * HomeController constructor.
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * @param string $language
     * @return mixed
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new HomeViewModel('home', $language);

        $this->homeService->fill($model);

        return view('pages.home', compact('model'));
    }
}
