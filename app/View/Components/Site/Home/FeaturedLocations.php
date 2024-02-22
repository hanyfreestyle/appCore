<?php

namespace App\View\Components\Site\Home;

use App\Models\admin\Location;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedLocations extends Component
{
    public $locations;

    public function __construct()
    {
        $locations = Location::query()
            ->where('is_active',true)
            ->orderBy('projects_count','desc')
            ->limit('10')
            ->get();

        $this->locations = $locations ;

    }

    public function render(): View|Closure|string
    {
        return view('components.site.home.featured-locations');
    }
}
