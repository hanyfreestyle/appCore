<?php

namespace App\View\Components\Site\Unit;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardList extends Component
{

    public $unit ;
    public $showmore ;
    public $showmorestyle;
    public $lazy;
    public $defremove;
    public $removefrom;

    public function __construct(
        $unit = array(),
        $showmore = true,
        $lazy = true,
        $showmorestyle = ' ty-compact-list-units ',
        $defremove = true,
        $removefrom = "normal",

    )
    {
        $this->unit = $unit;
        $this->lazy = $lazy;
        $this->showmore = $showmore;
        $this->showmorestyle = $showmorestyle;

        if($this->showmore == false){
            $this->showmorestyle = '';
        }
        $this->defremove = $defremove;
        $this->removefrom = $removefrom;
    }

    public function render(): View|Closure|string
    {
        $cart = Cart::content();
        return view('components.site.unit.card-list',compact('cart'));
    }
}
