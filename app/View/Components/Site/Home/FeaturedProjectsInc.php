<?php

namespace App\View\Components\Site\Home;

use App\Models\admin\Listing;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedProjectsInc extends Component
{
    public $locationid ;
    public $projects ;
    public function __construct
    (
        $locationid ,

    )
    {

        $this->locationid = $locationid;

        $projects = Listing::query()
            ->where('is_published',true)
            ->where('listing_type','Project')
            ->where('location_id',$this->locationid)
            ->orderBy('units_count','desc')
            ->limit('4')
            ->get();
        $this->projects = $projects ;
    }
    public function render(): View|Closure|string
    {
        return view('components.site.home.featured-projects-inc');
    }
}
