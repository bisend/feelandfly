<?php

namespace App\ViewModels;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentViewModel extends LayoutViewModel
{
    public function __construct(string $view, string $language)
    {
        parent::__construct($view, $language);
    }
}
