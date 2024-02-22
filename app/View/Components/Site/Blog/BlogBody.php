<?php

namespace App\View\Components\Site\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogBody extends Component
{
    public $post ;
    public $project;

    public function __construct(
        $post = array(),
        $project = array(),
    )
    {
        $this->post = $post;
        $this->project = $project;

    }

    public function render(): View|Closure|string
    {
        return view('components.site.blog.blog-body');
    }
}
