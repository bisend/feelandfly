<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;

class OrderPaymentController extends LayoutController
{
    public function __construct(ProfileService $profileService)
    {
        parent::__construct($profileService);
    }

    public function index($orderId = null)
    {

    }
}
