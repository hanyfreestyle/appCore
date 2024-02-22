<?php

namespace App\View\Components\Admin\Realestate;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckDataButton extends Component
{
    public $photo ;
    public $slug ;
    public $row ;
    public $subid ;
    public function __construct(
        $photo = true,
        $slug = true,
        $row = array(),
        $subid = null,
    )
    {
        $this->photo = $photo;
        $this->slug = $slug;
        $this->row = $row;
        $this->subid = $subid;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.realestate.check-data-button');
    }
}
