<?php

namespace App\View\Components\Site\Blog;

use App\Models\admin\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryList extends Component
{

    public $categories ;

    public function __construct()
    {
        $categories = Category::query()
            ->where('is_active',true)
            ->withCount('posts')
            ->with('translation')
            ->orderBy('posts_count','desc')
            ->get();

        $this->categories = $categories ;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.blog.category-list');
    }
}
