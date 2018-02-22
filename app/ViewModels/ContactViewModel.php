<?php

namespace App\ViewModels;

class ContactViewModel extends LayoutViewModel
{
    public function __construct(string $view, string $language)
    {
        parent::__construct($view, $language);
    }
}
