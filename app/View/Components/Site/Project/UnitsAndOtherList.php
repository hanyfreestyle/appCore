<?php

namespace App\View\Components\Site\Project;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UnitsAndOtherList extends Component
{
    public $row ;
    public $title;
    public $other;
    public function __construct(
        $row = array(),
        $other = array(),
        $title = null,

    )
    {
        $this->row = $row;
        $this->other = $other;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.project.units-and-other-list');
    }
}
