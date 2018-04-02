<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use App\ViewModels\MyOrdersViewModel;
use JavaScript;

/**
 * Class MyOrdersController
 * @package App\Http\Controllers\Profile
 */
class MyOrdersController extends LayoutController
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * MyOrdersController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        parent::__construct($profileService);
        
        $this->profileService = $profileService;
    }

    /**
     * my orders page in profile
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!auth()->check())
        {
            return redirect(url_home($language));
        }

        $model = new MyOrdersViewModel('profile-my-orders', $language, 1);
        
        $this->profileService->fill($model);
        
        $this->profileService->fillDeliveries($model);

        $this->profileService->getOrders($model);

        $this->profileService->getOrdersItems($model);
        
        $this->profileService->getTotalOrdersCount($model);

        JavaScript::put([
            'orders' => $model->orders,
            'page' => $model->page,
            'payments' => $model->payments,
            'deliveries' => $model->deliveries,
            'totalOrdersCount' => $model->totalOrdersCount
        ]);
        
        return view('pages.my-orders', compact('model'));
    }

    /**
     * method handles pagination of my orders
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexPagination()
    {
        $page = request('page');
        
        $language = request('language');

        $model = new MyOrdersViewModel('my-orders', $language, $page);

//        $this->profileService->fill($model);

        $this->profileService->fillDeliveries($model);

        $this->profileService->getOrders($model);

        $this->profileService->getOrdersItems($model);

        $this->profileService->getTotalOrdersCount($model);

        return response()->json([
            'orders' => $model->orders,
            'page' => $model->page,
            'payments' => $model->payments,
            'deliveries' => $model->deliveries,
            'totalOrdersCount' => $model->totalOrdersCount
        ]);
    }
}
