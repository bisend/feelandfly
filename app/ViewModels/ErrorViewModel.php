<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 20.12.2017
 * Time: 17:30
 */

namespace App\ViewModels;


class ErrorViewModel extends LayoutViewModel
{
    public $error;
    
    public function __construct($view, $language, $error = null)
    {
        parent::__construct($view, $language);
        
        $this->error = $error;
    }
}