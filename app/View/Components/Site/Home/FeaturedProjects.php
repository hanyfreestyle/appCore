<?php

namespace App\View\Components\Site\Home;

use App\Models\admin\Location;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedProjects extends Component
{
    public $title;
    public $locations;


    public function __construct(
        $title = null ,
    )
    {
        if ($this->title == null){
            $this->title = __('web/home.title_featured_projects') ;
        }else{
            $this->title  = $title;
        }

        $locations = Location::query()
            ->where('is_active',true)
            ->where('projects_count','>',0)
            ->orderBy('projects_count','desc')
            ->limit('4')
            ->get();
        $this->locations = $locations ;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.home.featured-projects');
    }
}
