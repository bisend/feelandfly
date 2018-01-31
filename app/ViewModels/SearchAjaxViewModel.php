<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 28.11.2017
 * Time: 14:56
 */

namespace App\ViewModels;

use App\DatabaseModels\UserType;
use App\Helpers\Languages;

/**
 * Class SearchAjaxViewModel
 * @package App\ViewModels
 */
class SearchAjaxViewModel
{
    /**
     * @var
     */
    public $searchProducts;

    /**
     * @var
     */
    public $countSearchProducts;

    /**
     * @var string
     */
    public $language;

    /**
     * @var null
     */
    public $series;

    /**
     * @var integer should contain id of type user
     */
    public $userTypeId;

    /**
     * SearchAjaxViewModel constructor.
     * @param null $series
     * @param string $language
     */
    public function __construct($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $this->series = $series;

        $this->language = $language;

        if (auth()->check())
        {
            $this->userTypeId = auth()->user()->user_type_id;
        }
        else
        {
            $userType = UserType::whereIsDefault(true)->first();
            $this->userTypeId = $userType->id;
        }
    }
}