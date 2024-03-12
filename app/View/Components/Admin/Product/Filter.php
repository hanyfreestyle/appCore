<?php

namespace App\View\Components\Admin\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Filter extends Component {

    public $getSessionData;
    public $row;
    public $fromDate;
    public $toDate;
    public $formName;
    public $isActive;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $fromDate = true,
        $toDate = true,
        $formName = 'ProductFilters',
        $isActive = true,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->formName = $formName;
        $this->isActive = $isActive;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;

        $this->getSessionData = Session::get($this->formName);

    }

    public function render(): View|Closure|string {
        return view('components.admin.product.filter');
    }
}
