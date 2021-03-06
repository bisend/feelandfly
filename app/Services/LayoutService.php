<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 11:57
 */

namespace App\Services;

use App\DatabaseModels\Profile;
use App\Helpers\Languages;
use App\Repositories\CategoryRepository;
use JavaScript;
use Session;

/**
 * Class LayoutService
 * @package App\Services
 */
class LayoutService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * LayoutService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        $this->localizeApplication($model);
        $this->fillCategories($model);
        $this->checkUserSocialEmail();
        $this->checkIsOrderCreated();
        $this->checkAuth();
    }

    /**
     * set locale APP
     * @param $model
     */
    private function localizeApplication($model)
    {
        Languages::localizeApp($model->language);
    }

    /**
     * fill model categories
     * @param $model 
     */
    private function fillCategories($model)
    {
        $model->categories = $this->categoryRepository->getCategories($model->language);

        foreach ($model->categories as $category)
        {
            if ($category->childs->count() > 0)
            {
                $category->hasSecondLevel = true;
                
                $category->hasThirdLevel = false;

                foreach ($category->childs as $secondChild)
                {
                    if ($secondChild->childs && $secondChild->childs->count() > 0)
                    {
                        $category->hasThirdLevel = true;
                    }
                }
            }
            else
            {
                $category->hasSecondLevel = false;
            }
        }
    }

    /**
     * check if social email exist in session put on js
     */
    private function checkUserSocialEmail()
    {
        if (Session::has('social_email'))
        {
            JavaScript::put([
                'social_email' => Session::get('social_email')
            ]);
        }
    }

    /**
     * check if order created to show pop up
     */
    private function checkIsOrderCreated()
    {
        if (Session::has('isOrderCreated'))
        {
            JavaScript::put([
                'isOrderCreated' => Session::get('isOrderCreated')
            ]);

            Session::remove('isOrderCreated');
        }
    }

    /**
     * check if user auth put on js
     */
    private function checkAuth()
    {
        if (auth()->check())
        {
            $user = auth()->user();
            $profile = Profile::whereUserId($user->id)->first();

            JavaScript::put([
                'auth' => [
                    'user' => $user,
                    'profile' => $profile
                ]
            ]);
        }
    }
}