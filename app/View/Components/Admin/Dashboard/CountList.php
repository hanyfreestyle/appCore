<?php

namespace App\View\Components\Admin\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountList extends Component
{
    public $name;
    public $cardCount ;
    public $url ;
    public $lable ;
    public function __construct(
        $name = null,
        $cardCount = array(),
        $url = null,
        $lable = null,
    )
    {
        $this->name = $name ;
        $this->cardCount = $cardCount ;
        $this->url = $url ;
        $this->lable = $lable ;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.dashboard.count-list');
    }
}
