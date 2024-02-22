<?php

namespace App\View\Components\Site\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardList extends Component
{
    public $post;
    public function __construct(
        $post = array(),
    )
    {
        $this->post = $post;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.blog.card-list');
    }
}
