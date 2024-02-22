<?php

namespace App\Http\Livewire\Site;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class FavoriteMenu extends Component
{
    protected $listeners = ['cart_updated'=>'render'];

    public function render(){
        $facCount = Cart::content()->count();
        if($facCount > 99){
            $facCount = 99 ;
        }
        return view('livewire.site.favorite-menu')->with(["facCount" => $facCount]);
    }
}
