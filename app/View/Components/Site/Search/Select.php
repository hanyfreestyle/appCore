<?php

namespace App\View\Components\Site\Search;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{

    public $sendArr;
    public $name;
    public $label;
    public $defSelect;
    public $printVal;
    public $thisarr;
    public $labelview;
    public $option_6;
    public $option_7;

    public function __construct(
        $sendArr = array(),
        $name = true,
        $label = null,
        $defSelect = null,
        $printVal = "id",
        $thisarr = true,
        $labelview = true,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->sendArr = $sendArr;
        $this->name = $name;
        $this->label = $label;
        $this->defSelect = $defSelect;


        if($this->defSelect == null){
            $this->defSelect = __('web/search.view_all');
        }

        $this->printVal = $printVal;
        $this->thisarr = $thisarr;
        $this->labelview = $labelview;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.search.select');
    }
}
