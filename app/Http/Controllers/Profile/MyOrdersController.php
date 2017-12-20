<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use App\ViewModels\MyOrdersViewModel;
use JavaScript;

class MyOrdersController extends LayoutController
{
    protected $profileService;
    
    public function __construct(ProfileService $profileService)
    {
        parent::__construct($profileService);
        
        $this->profileService = $profileService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!auth()->check())
        {
            return redirect(url_home($language));
        }

        $model = new MyOrdersViewModel('my-orders', $language, 1);
        
        $this->profileService->fill($model);
        
        $this->profileService->fillPayments($model);
        
        $this->profileService->fillDeliveries($model);

        $this->profileService->getOrders($model);

        $this->profileService->getOrdersItems($model);
        
        $this->profileService->getTotalOrdersCount($model);

        \Debugbar::info($model);

        JavaScript::put([
            'orders' => $model->orders,
            'page' => $model->page,
            'payments' => $model->payments,
            'deliveries' => $model->deliveries,
            'totalOrdersCount' => $model->totalOrdersCount
        ]);
        
        return view('pages.my-orders', compact('model'));
    }

    public function indexPagination()
    {
        $page = request('page');
        
        $language = request('language');

        $model = new MyOrdersViewModel('my-orders', $language, $page);

        $this->profileService->fill($model);

        $this->profileService->fillPayments($model);

        $this->profileService->fillDeliveries($model);

        $this->profileService->getOrders($model);

        $this->profileService->getOrdersItems($model);

        $this->profileService->getTotalOrdersCount($model);

        \Debugbar::info($model);

        return response()->json([
            'orders' => $model->orders,
            'page' => $model->page,
            'payments' => $model->payments,
            'deliveries' => $model->deliveries,
            'totalOrdersCount' => $model->totalOrdersCount
        ]);
    }
}
