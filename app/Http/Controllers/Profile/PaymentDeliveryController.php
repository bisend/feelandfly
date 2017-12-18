<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use App\ViewModels\PaymentDeliveryViewModel;
use DB;
use JavaScript;

class PaymentDeliveryController extends LayoutController
{
    protected $profileService;
    
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!auth()->check())
        {
            return redirect(url_home($language));
        }
        
        $model = new PaymentDeliveryViewModel('payment-delivery', $language);
        
        $this->profileService->fill($model);

        $this->profileService->fillPayments($model);

        $this->profileService->fillDeliveries($model);

        $this->profileService->fillSelectedPaymentId($model);

        $this->profileService->fillSelectedDeliveryId($model);

        $this->profileService->fillAddress($model);

        JavaScript::put([
            'selectedPaymentId' => $model->selectedPaymentId,
            'selectedDeliveryId' => $model->selectedDeliveryId,
            'address' => $model->address
        ]);

        \Debugbar::info($model);
        
        return view('pages.payment-delivery', compact('model'));
    }

    public function savePaymentDelivery()
    {
        $paymentId = request('paymentId');

        $deliveryId = request('deliveryId');

        $address = request('address');

        DB::beginTransaction();

        try
        {
            $this->profileService->savePaymentDelivery($paymentId, $deliveryId, $address);
        }
        catch (\Exception $e)
        {
            \Debugbar::info($e->getMessage());
            DB::rollBack();
            return response()->json([
                'status' => 'error'
            ]);
        }
        
        DB::commit();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
