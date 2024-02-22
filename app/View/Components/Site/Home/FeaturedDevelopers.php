<?php

namespace App\View\Components\Site\Home;

use App\Models\admin\Developer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedDevelopers extends Component
{
    public $developers ;
    public $title ;

    public function __construct(
        $title = null,
    )
    {
        $developers = Developer::query()
            ->where('is_active',true)
            ->orderBy('units_count','desc')
            ->limit('10')
            ->get();

        $this->developers = $developers ;

        if($this->title == null){
            $this->title = __('web/home.title_featured_developers');
        }else{
            $this->title = $title ;
        }

    }

    public function render(): View|Closure|string
    {
        return view('components.site.home.featured-developers');
    }
}
