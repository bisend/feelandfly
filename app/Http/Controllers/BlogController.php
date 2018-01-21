<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\BlogService;
use App\Services\ProfileService;
use App\ViewModels\BlogViewModel;
use Illuminate\Http\Request;

class BlogController extends LayoutController
{
    protected $blogService;
    
    public function __construct(ProfileService $profileService, BlogService $blogService)
    {
        parent::__construct($profileService);

        $this->blogService = $blogService;
    }

    public function blogPage($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new BlogViewModel('blog', $language, $slug, 1);
        
        $this->blogService->fill($model);

        $this->blogService->fillBlog($model);

        $this->blogService->incrementBlogViewCount($model);

        $this->blogService->fillPopularBlogs($model);

        \Debugbar::info($model);

        return view('pages.blog', compact('model'));
    }
    
    public function allBlogs($language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new BlogViewModel('all-blogs', $language, null, 1);

        $this->blogService->fill($model);

        $this->blogService->fillAllBlogs($model);

        \Debugbar::info($model);

        return view('pages.all-blogs', compact('model'));
    }
    
    public function allBlogsPagination($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new BlogViewModel('all-blogs', $language, null, $page);

        $this->blogService->fill($model);

        $this->blogService->fillAllBlogs($model);

        \Debugbar::info($model);

        return view('pages.all-blogs', compact('model'));
    }
}
