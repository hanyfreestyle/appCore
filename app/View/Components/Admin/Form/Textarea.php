<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $disabled, $required;
    public $rows;
    public $requiredSpan ;
    public $horizontalLabel ;
    public $value;
    public $labelview;
    public function __construct(
        $id = null, $name = null,
        $label = 'Input Label', $placeholder = null,
        $topclass = null, $inputclass = null,
        $disabled = false, $required = false,
        $rows = '5',
        $requiredSpan = false,
        $value = null,
        $horizontalLabel =false,
        $labelview = true,

    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->rows = $rows;
        $this->requiredSpan = $requiredSpan;
        $this->horizontalLabel = $horizontalLabel;
        $this->value = $value;
        $this->labelview = $labelview;

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.form.textarea');
    }
}
