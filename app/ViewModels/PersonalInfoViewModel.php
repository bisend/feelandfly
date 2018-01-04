<?php

namespace App\ViewModels;

/**
 * Class PersonalInfoViewModel
 * @package App\ViewModels
 */
class PersonalInfoViewModel extends LayoutViewModel
{
    /**
     * PersonalInfoViewModel constructor.
     * @param string $view
     * @param string $language
     */
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
