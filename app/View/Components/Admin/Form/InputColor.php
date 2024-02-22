<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputColor extends Component
{
    public $name;
    public $label;
    public $value;
    public function __construct(
        $name ="",
        $label = "",
        $value = "",

    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }


    public function render(): View|Closure|string
    {
        return view('components.admin.form.input-color');
    }
}
