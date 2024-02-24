<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransInput extends Component
{

    public $label ;
    public $name ;
    public $reqname ;
    public $value ;
    public $dir ;
    public $newreqname ;
    public $reqspan ;
    public $placeholder ;
    public $placeholderPrint ;
    public $tdir ;
    public function __construct(
        $label = null,
        $name,
        $reqname,
        $value,
        $dir="null",
        $newreqname = "",
        $placeholderPrint = "",
        $placeholder = false,
        $reqspan = true,
        $tdir = null,
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->reqname = $reqname;
        $this->dir = $dir;
        $this->reqspan = $reqspan;

        $this->newreqname =  trim(str_replace('_', " ", $this->reqname)) ;

        $this->placeholder = $placeholder;
        if($this->placeholder == true){
            $this->placeholderPrint = $this->label;
        }

        if($tdir != null){
            $this->tdir = $tdir ;
        }else{
            $this->tdir = $dir ;
        }


    }

    public function render(): View|Closure|string
    {
        return view('components.admin.form.trans-input');
    }
}
