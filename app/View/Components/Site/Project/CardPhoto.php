<?php

namespace App\View\Components\Site\Project;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPhoto extends Component
{
    public $project;
    public $cardstyle ;
    public $removefrom ;
    public $lazy ;

    public function __construct(
        $project = array(),
        $cardstyle = "",
        $removefrom = "normal",
        $lazy = true,

    )
    {
        $this->project = $project;
        $this->cardstyle = $cardstyle;
        $this->removefrom = $removefrom;
        $this->lazy = $lazy;
    }
    public function render(): View|Closure|string
    {
        return view('components.site.project.card-photo');
    }
}
