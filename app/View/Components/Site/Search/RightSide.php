<?php

namespace App\View\Components\Site\Search;

use App\Http\Controllers\DefaultMainController;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RightSide extends Component{

    public $locations ;
    public $DeveloperArr ;
    public $route ;
    public $developer ;
    public $project ;


    public function __construct(
        $route = null,
        $developer = true,
        $project = true,

    )
    {
        $this->locations = DefaultMainController::CashLocationList(0);
        $this->DeveloperArr = DefaultMainController::CashDeveloperList(0);
        $this->route = $route;
        $this->developer = $developer;
        $this->project = $project;

    }

    public function render(): View|Closure|string
    {
        return view('components.site.search.right-side');
    }
}
