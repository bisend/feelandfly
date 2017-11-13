<?php

namespace App\ViewModels;

/**
 * Class HomeViewModel
 * @package App\ViewModels
 */
class HomeViewModel extends LayoutViewModel
{
    /**
     * HomeViewModel constructor.
     * @param string $view
     * @param string $language
     */
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
