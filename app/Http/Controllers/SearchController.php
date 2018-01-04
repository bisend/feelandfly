<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\SearchService;
use App\ViewModels\SearchAjaxViewModel;
use App\ViewModels\SearchViewModel;
use JavaScript;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends LayoutController
{
    /**
     * @var SearchService
     */
    protected $searchService;

    /**
     * SearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * search page with results
     * @param null $series
     * @param string $language
     * @return mixed
     */
    public function index($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, 'default', 1);
        
        $this->searchService->fill($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);
        
        return view('pages.search', compact('model'));
    }

    /**
     * search page with sort
     * @param null $series
     * @param string $sort
     * @param string $language
     * @return mixed
     */
    public function indexSort($series = null, $sort = 'default', $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, $sort, 1);

        $this->searchService->fill($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);

        return view('pages.search', compact('model'));
    }

    /**
     * search page with pagination
     * @param null $series
     * @param int $page
     * @param string $language
     * @return mixed
     */
    public function indexPagination($series = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, 'default', $page);

        $this->searchService->fill($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);

        return view('pages.search', compact('model'));
    }

    /**
     * search page with pagination and sort
     * @param null $series
     * @param string $sort
     * @param int $page
     * @param string $language
     * @return mixed
     */
    public function indexPaginationSort($series = null, $sort = 'default', $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new SearchViewModel('search', $language, $series, $sort, $page);

        $this->searchService->fill($model);

        JavaScript::put([
            'products' => $model->searchProducts
        ]);

        return view('pages.search', compact('model'));
    }

    /**
     * ajax search
     * @param null $series
     * @param string $language
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexAjax($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $model = new SearchAjaxViewModel($series, $language);

        $this->searchService->fillAjax($model);

        return response()->json([
            'status' => 'success',
            'searchProducts' => $model->searchProducts,
            'countSearchProducts' => $model->countSearchProducts
        ]);
    }
}
