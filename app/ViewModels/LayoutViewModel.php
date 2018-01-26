<?php

namespace App\ViewModels;

use App\DatabaseModels\Profile;
use App\DatabaseModels\User;
use App\DatabaseModels\UserType;

/**
 * Class LayoutViewModel
 * @package App\ViewModels
 */
abstract class LayoutViewModel
{
    /**
     * @var string|null Should contain page name
     */
    public $view;

    /**
     * @var string Should contain global language locale
     */
    public $language;

    /**
     * @var mixed categories Should contain all categories
     */
    public $categories;

    /**
     * @var integer should contain id of type user
     */
    public $userTypeId;

    /**
     * @var \Illuminate\Database\Eloquent\Model|null|static
     */
    public $user;

    /**
     * @var \Illuminate\Database\Eloquent\Model|null|static
     */
    public $profile;

    /**
     * LayoutViewModel constructor.
     * @param string $view
     * @param string $language
     */
    public function __construct($view, $language)
    {
        $this->view = $view;
        
        $this->language = $language;

        $userType = UserType::whereIsDefault(true)->first();

        $this->userTypeId = $userType->id;

        if (auth()->check())
        {
            $this->userTypeId = auth()->user()->user_type_id;
            
            $this->user = User::whereId(auth()->user()->id)->first();

            $this->profile = Profile::whereUserId($this->user->id)->first();
        }
    }
}
