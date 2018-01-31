<?php

namespace App\Http\Controllers;

use App\DatabaseModels\UserType;
use App\Helpers\Languages;
use App\Mail\OrderReport;
use App\Mail\OrderReportManager;
use App\Services\CartService;
use App\Services\OrderService;
use App\ViewModels\OrderViewModel;
use DB;
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
     * OrderController constructor.
     * @param OrderService $orderService
     * @param CartService $cartService
     */
    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        
        $this->cartService = $cartService;
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

        $this->cartService->fill($model->language, $userTypeId);

        DB::beginTransaction();

        $this->orderService->createOrder($data, $userId, $userTypeId, $model, $this->cartService);

        $this->orderService->createOrderProducts($model, $this->cartService);

        try
        {
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

        Session::put('isOrderCreated', true);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
