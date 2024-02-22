<?php

namespace App\View\Components\Site\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RelatedProjects extends Component
{

    public $relatedProjects;

    public function __construct
    (
        $relatedProjects = array(),
    )
    {
        $this->relatedProjects = $relatedProjects;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.blog.related-projects');
    }
}
