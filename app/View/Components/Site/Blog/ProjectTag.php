<?php

namespace App\View\Components\Site\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectTag extends Component
{

    public $projects;


    public function __construct(
        $projects = array(),

    )
    {
        $this->projects = $projects;

    }

    public function render(): View|Closure|string
    {
        return view('components.site.blog.project-tag');
    }
}
