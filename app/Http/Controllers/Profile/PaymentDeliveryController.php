<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Languages;
use App\Http\Controllers\LayoutController;
use App\Services\ProfileService;
use App\ViewModels\PaymentDeliveryViewModel;
use DB;
use JavaScript;

/**
 * Class PaymentDeliveryController
 * @package App\Http\Controllers\Profile
 */
class PaymentDeliveryController extends LayoutController
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * PaymentDeliveryController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * payment delivery page in profile
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!auth()->check())
        {
            return redirect(url_home($language));
        }
        
        $model = new PaymentDeliveryViewModel('profile-payment-delivery', $language);
        
        $this->profileService->fill($model);

        //deliveries
        $this->profileService->fillDeliveries($model);
        $this->profileService->fillSelectedDeliveryId($model);
        $this->profileService->fillSelectedDelivery($model);

        //delivery types
        $this->profileService->fillDeliveryTypes($model);
        $this->profileService->fillSelectedDeliveryTypeId($model);
        $this->profileService->fillSelectedDeliveryType($model);



        \Debugbar::info($model);

        JavaScript::put([
            'deliveries' => $model->deliveries,
            'deliveryTypes' => $model->deliveryTypes,
            'delivery' => $model->delivery,
            'deliveryType' => $model->deliveryType
        ]);
        
        return view('pages.payment-delivery', compact('model'));
    }

    /**
     * method handles saving of user payment and delivery
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePaymentDelivery()
    {
        \Debugbar::info(request()->all());
        $deliveryId = request('deliveryId');
        $deliveryTypeId = request('deliveryTypeId');

        try
        {
            DB::beginTransaction();
            $this->profileService->savePaymentDelivery($deliveryId, $deliveryTypeId);
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
