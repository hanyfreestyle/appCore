<?php

namespace App\View\Components\Site\Def;

use App\Http\Controllers\WebMainController;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Amenities extends Component
{
    public $row ;
    public $title;
    public $senddata;

    public function __construct(
        $row = array(),
        $title = null,
        $senddata = null,
    )
    {
        $this->row = $row;
        $this->title = $title;
        $this->senddata = $senddata;
    }

    public function render(): View|Closure|string
    {
        $amenities = WebMainController::CashAmenityList(0);
        return view('components.site.def.amenities',compact('amenities'));
    }
}
