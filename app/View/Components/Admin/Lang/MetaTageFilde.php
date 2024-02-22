<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaTageFilde extends Component
{
    public $key;
    public $row;
    public $reqspan;
    public $viewtype;
    public function __construct(
        $key = null,
        $row = array(),
        $reqspan = true,
        $viewtype = "Add",
    )
    {
        $this->key = $key ;
        $this->row = $row ;
        if($viewtype == 'Add'){
            $this->reqspan = false ;
        }else{
            $this->reqspan = $reqspan ;
        }

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.lang.meta-tage-filde');
    }
}
