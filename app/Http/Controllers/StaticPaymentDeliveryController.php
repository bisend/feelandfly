<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\ProfileService;
use App\Services\StaticPaymentDeliveryService;
use App\ViewModels\StaticPaymentDeliveryViewModel;

class StaticPaymentDeliveryController extends LayoutController
{
    private $staticPaymentDeliveryService;

    public function __construct(ProfileService $profileService, StaticPaymentDeliveryService $staticPaymentDeliveryService)
    {
        parent::__construct($profileService);

        $this->staticPaymentDeliveryService = $staticPaymentDeliveryService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new StaticPaymentDeliveryViewModel('static-payment-delivery', $language);

        $this->staticPaymentDeliveryService->fill($model);

        \Debugbar::info($model);

        return view('pages.static-payment-delivery', compact('model'));
    }
}
