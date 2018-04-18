<?php

namespace App\Http\Controllers;

use App\DatabaseModels\UserType;
use App\Helpers\Languages;
use App\Mail\OrderReport;
use App\Mail\OrderReportManager;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProfileService;
use App\ViewModels\OrderViewModel;
use DB;
use JavaScript;
use Session;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends LayoutController
{
    /**
     * @var OrderService
     */
    protected $orderService;
    
    /**
     * @var CartService
     */
    protected $cartService;

    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     * @param CartService $cartService
     * @param ProfileService $profileService
     */
    public function __construct(OrderService $orderService, CartService $cartService, ProfileService $profileService)
    {
        $this->orderService = $orderService;
        
        $this->cartService = $cartService;

        $this->profileService = $profileService;
    }

    /**
     * order page
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        if (!Session::has('cart'))
        {
            return redirect(url_home($language));
        }

        $model = new OrderViewModel('order', $language);

        $this->orderService->fill($model);

        $this->fillProfileDeliveriesFields($model);

        Javascript::put([
            'deliveries' => $model->deliveries,
            'deliveryTypes' => $model->deliveryTypes,
            'delivery' => $model->delivery,
            'deliveryType' => $model->deliveryType,
            'countries' => $model->countries,
            'country' => $model->country,
            'checkoutPoints' => $model->checkoutPoints,
            'checkoutPoint' => $model->checkoutPoint,
            'selectedCityRef' => $model->selectedCityRef,
            'selectedWarehouseRef' => $model->selectedWarehouseRef,
            'selectedStreet' => $model->selectedStreet,
            'selectedLand' => $model->selectedLand,
            'selectedCity' => $model->selectedCity,
            'selectedIndex' => $model->selectedIndex,
        ]);

        \Debugbar::info($model);

        return view('pages.order', compact('model'));
    }

    /**
     * creating new order
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $data = request()->all();

        \Debugbar::info($data);

        if (auth()->check())
        {
            $userId = auth()->id();
            $userTypeId = auth()->user()->user_type_id;
        }
        else
        {
            $userId = null;
            $userType = UserType::whereIsDefault(true)->first();
            $userTypeId = $userType->id;
        }

        $model = new OrderViewModel('order', request('language'));

        $this->orderService->fill($model);

        $this->fillProfileDeliveriesFields($model);

        $this->cartService->fill($model->language, $userTypeId);

        try
        {
            DB::beginTransaction();

            $this->orderService->createOrder($data, $userId, $userTypeId, $model, $this->cartService);

            $this->orderService->createOrderProducts($model, $this->cartService);

            \Mail::to(request('email'))->send(new OrderReport($model, request('name'), $this->cartService));

            \Mail::to(config('mail.from.address'))->send(new OrderReportManager($model, request('name'), $this->cartService));
        }
        catch (\Exception $e)
        {
            \Debugbar::info($e->getMessage());

            DB::rollBack();

            return response()->json([
                'status' => 'error'
            ]);
        }

        $this->cartService->clearCart();

        DB::commit();

        $url = url_order_payment_order($model->order->order_number, $model->language);

//        Session::put('isOrderCreated', true);

        return response()->json([
            'status' => 'success',
            'url' => $url
        ]);
    }

    public function fillProfileDeliveriesFields($model)
    {
        //deliveries
        $this->profileService->fillDeliveries($model);
        $this->profileService->fillDeliveryTypes($model);
        $this->profileService->fillCountries($model);
        $this->profileService->fillCheckoutPoints($model);

        if (auth()->check())
        {
            $this->profileService->fillSelectedDeliveryId($model);
            $this->profileService->fillSelectedDelivery($model);

            //delivery types
            $this->profileService->fillSelectedDeliveryTypeId($model);
            $this->profileService->fillSelectedDeliveryType($model);

            //countries
            $this->profileService->fillSelectedCountryCode($model);
            $this->profileService->fillSelectedCountry($model);

            //checkout points
            $this->profileService->fillSelectedCheckoutPointId($model);
            $this->profileService->fillSelectedCheckoutPoint($model);

            //city
            $this->profileService->fillSelectedCityRef($model);
            $this->profileService->fillSelectedWarehouseRef($model);

            //address delivery fields
            $this->profileService->fillSelectedStreet($model);
            $this->profileService->fillSelectedLand($model);
            $this->profileService->fillSelectedCity($model);
            $this->profileService->fillSelectedIndex($model);
        }
    }
}
