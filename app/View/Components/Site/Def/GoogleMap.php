<?php

namespace App\View\Components\Site\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GoogleMap extends Component
{
    public $row ;
    public $title;
    public $lat;
    public $long;
    public function __construct(
        $row = array(),
        $title = null,
        $lat = null,
        $long = null,

    )
    {
        $this->row = $row;
        $this->lat = $lat;
        $this->long = $long;

        if($this->row->listing_type == 'Project' or $this->row->listing_type == 'ForSale' ){
            if($this->row->latitude != null and  $this->row->longitude != null ){
                $this->lat = $this->row->latitude;
                $this->long =  $this->row->longitude;
            }
        }elseif ($this->row->listing_type == 'Unit'){
            if($this->row->latitude == null and  $this->row->longitude == null ){
                if($this->row->projectName->latitude  != null and  $this->row->projectName->longitude != null )
                    $this->lat = $this->row->projectName->latitude;
                $this->long =  $this->row->projectName->longitude;
            }
        }

        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.def.google-map');
    }
}
