<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 12.12.2017
 * Time: 14:37
 */

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\DeliveryRepository;
use App\Repositories\MetaTagRepository;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService extends LayoutService
{
    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;
    
    /**
     * @var DeliveryRepository
     */
    protected $deliveryRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderProductRepository
     */
    protected $orderProductRepository;

    protected $metaTagRepository;

    /**
     * OrderService constructor.
     * @param CategoryRepository $categoryRepository
     * @param PaymentRepository $paymentRepository
     * @param DeliveryRepository $deliveryRepository
     * @param OrderRepository $orderRepository
     * @param OrderProductRepository $orderProductRepository
     */
    public function __construct(CategoryRepository $categoryRepository,
                                PaymentRepository $paymentRepository,
                                DeliveryRepository $deliveryRepository,
                                OrderRepository $orderRepository, 
                                OrderProductRepository $orderProductRepository,
                                MetaTagRepository $metaTagRepository)
    {
        parent::__construct($categoryRepository);
        
        $this->paymentRepository = $paymentRepository;
        
        $this->deliveryRepository = $deliveryRepository;
        
        $this->orderRepository = $orderRepository;
        
        $this->orderProductRepository = $orderProductRepository;

        $this->metaTagRepository = $metaTagRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        parent::fill($model); // TODO: Change the autogenerated stub

        $this->fillPayments($model);
        
        $this->fillDeliveries($model);

        $this->fillMetaTags($model);
    }

    /**
     * fill payments
     * @param $model
     */
    private function fillPayments($model)
    {
        $model->payments = $this->paymentRepository->getAllPayments($model);
    }

    /**
     * fill deliveries
     * @param $model
     */
    private function fillDeliveries($model)
    {
        $model->deliveries = $this->deliveryRepository->getAllDeliveries($model);
    }

    /**
     * creating new order
     * @param $data
     * @param $userId
     * @param $userTypeId
     * @param $model
     * @param $cartService
     */
    public function createOrder($data, $userId, $userTypeId, $model, $cartService)
    {
        $model->order = $this->orderRepository->createOrder($data, $userId, $userTypeId, $model, $cartService);
    }

    /**
     * creating new order products
     * @param $model
     * @param $cartService
     */
    public function createOrderProducts($model, $cartService)
    {
        $this->orderProductRepository->createOrderProducts($model, $cartService);
    }

    private function fillMetaTags($model)
    {
        $metaTag = $this->metaTagRepository->getMetaTagByPageName($model);
        $model->title = $metaTag->title;
        $model->description = $metaTag->description;
        $model->keywords = $metaTag->keywords;
        $model->h1 = $metaTag->h1;
    }
}