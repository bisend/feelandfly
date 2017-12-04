<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\SearchService;
use App\ViewModels\SearchAjaxViewModel;
use App\ViewModels\SearchViewModel;
use JavaScript;

class SearchController extends LayoutController
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, 'default', 1);
        
        $this->searchService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);
        
        return view('pages.search', compact('model'));
    }

    public function indexSort($series = null, $sort = 'default', $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, $sort, 1);

        $this->searchService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);

        return view('pages.search', compact('model'));
    }

    public function indexPagination($series = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, 'default', $page);

        $this->searchService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);

        return view('pages.search', compact('model'));
    }

    public function indexPaginationSort($series = null, $sort = 'default', $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, $sort, $page);

        $this->searchService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);

        return view('pages.search', compact('model'));
    }

    public function indexAjax($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $model = new SearchAjaxViewModel($series, $language);

        $this->searchService->fillAjax($model);
        
        \Debugbar::info($model);

        return response()->json([
            'status' => 'success',
            'searchProducts' => $model->searchProducts,
            'countSearchProducts' => $model->countSearchProducts
        ]);
    }
}
