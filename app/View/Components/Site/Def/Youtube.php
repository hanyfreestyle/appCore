<?php

namespace App\View\Components\Site\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Youtube extends Component
{
    public $row ;
    public $vcode ;
    public $title;
    public function __construct(
        $row = array(),
        $title = null,
        $vcode = null,
    )
    {
        $this->row = $row;
        $this->title = $title;
        $this->vcode = $vcode;

    }
    public function render(): View|Closure|string
    {
        return view('components.site.def.youtube');
    }
}
