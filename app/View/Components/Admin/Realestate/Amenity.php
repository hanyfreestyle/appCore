<?php

namespace App\View\Components\Admin\Realestate;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Amenity extends Component
{
    public $sendData ;
    public $lable ;

    public function __construct(
        $sendData = array(),
        $lable = null ,
    )
    {
        if($sendData){
            $this->sendData = $sendData ;
        }else{
            $this->sendData = [] ;
        }

        if($lable){
            $this->lable = $lable ;
        }else{
            $this->lable = __('admin/project.amenity') ;
        }

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.realestate.amenity');
    }
}
