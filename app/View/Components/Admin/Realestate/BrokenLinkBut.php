<?php

namespace App\View\Components\Admin\Realestate;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BrokenLinkBut extends Component
{

    public $from;
    public $row;
    public $delete;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $from = null,
        $row = array(),
        $delete = false,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->from = $from;
        $this->row = $row;
        $this->delete = $delete;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.realestate.broken-link-but');
    }
}
