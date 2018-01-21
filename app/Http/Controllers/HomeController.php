<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\HomeService;
use App\ViewModels\HomeViewModel;
use JavaScript;

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
     * home page
     * @param string $language
     * @return mixed
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new HomeViewModel('home', $language);

        $this->homeService->fill($model);

        JavaScript::put([
            'mainSlider' => $model->mainSlider,
            'mainSliderProducts' => $model->mainSliderProducts,
            'salesProducts' => $model->salesProducts,
            'topProducts' => $model->topProducts,
            'newProducts' => $model->newProducts
        ]);
        
        \Debugbar::info($model);

        return view('pages.home', compact('model'));
    }
}
