<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SelectArr extends Component {
    public $name;
    public $label;
    public $sendvalue;
    public $requiredSpan;
    public $colrow;
    public $sendArr;
    public $selectType;
    public $printValName;
    public $labelview;
    public $applang;
    public $changelang;
    public $sendid;

    public function __construct(
        $name = "",
        $label = "",
        $sendvalue = "",
        $requiredSpan = true,
        $colrow = "col-lg-4",
        $sendArr = array(),
        $selectType = 'normal',
        $printValName = 'name',
        $labelview = true,
        $applang = null,
        $changelang = null,
        $sendid = 'id',

    ) {
        $this->name = $name;
        $this->label = $label;
        $this->printValName = $printValName;
        $this->sendvalue = $sendvalue;
        $this->requiredSpan = $requiredSpan;
        $this->colrow = $colrow;
        $this->sendArr = $sendArr;
        $this->selectType = $selectType;

        $this->labelview = $labelview;
        $this->sendid = $sendid;

        $this->applang = LaravelLocalization::getCurrentLocale();
        if($this->applang == 'ar') {
            $this->changelang = 'en';
        } else {
            $this->changelang = 'ar';
        }





    }

    public function render(): View|Closure|string {
        return view('components.admin.form.select-arr');
    }
}
