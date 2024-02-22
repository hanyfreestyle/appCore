<?php

namespace App\View\Components\Site\Unit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoCard extends Component
{
    public $row ;
    public $title;
    public function __construct(
        $row = array(),
        $title = null,

    )
    {
        $this->row = $row;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.unit.info-card');
    }
}
