<?php

namespace App\View\Components\Site\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RelatedSlider extends Component
{
    public $posts;
    public $titel;
    public function __construct(
        $posts = array(),
        $titel = null,

    )
    {
        $this->posts = $posts;
        $this->titel = $titel;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.blog.related-slider');
    }
}
