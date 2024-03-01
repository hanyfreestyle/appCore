<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectMultiple extends Component {

    public $name;
    public $label;
    public $labelView;
    public $sendvalue;
    public $req;
    public $col;
    public $sendArr;
    public $selectType;
    public $printValName;

    public function __construct(
        $name = "",
        $label = null,
        $labelView = true,
        $sendvalue = "",
        $req = true,
        $col = "12",
        $sendArr = array(),
        $selectType = 'normal',
        $printValName = 'name',
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->labelView = $labelView;
        if($this->label == null){
            $this->label = __('admin/form.sel_categories') ;
        }
        $this->sendvalue = $sendvalue;
        $this->req = $req;
        $this->col = $col;
        $this->sendArr = $sendArr;
        $this->selectType = $selectType;
        $this->printValName = $printValName;
    }


    public function render(): View|Closure|string {
        return view('components.admin.form.select-multiple');
    }
}
