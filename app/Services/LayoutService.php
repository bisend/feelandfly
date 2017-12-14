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
    }
    
    private function checkUserSocialEmail()
    {
        if (Session::has('social_email'))
        {
            JavaScript::put([
                'social_email' => Session::get('social_email')
            ]);
        }
    }

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