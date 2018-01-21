<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 21.01.2018
 * Time: 16:37
 */

namespace App\ViewModels;


class BlogViewModel extends LayoutViewModel
{
    public $slug;
    
    public $blog;

    public $blogs;
    
    public $blogsCount = 0;
    
    public $popularBlogs;

    public $limit = 9;

    public $offset = 0;

    public $page = 1;

    public function __construct($view, $language, $slug, $page = 1)
    {
        parent::__construct($view, $language);
        
        $this->slug = $slug;
        
        $this->page = $page;
        
        $this->offset = ($this->page - 1) * $this->limit;
    }
}