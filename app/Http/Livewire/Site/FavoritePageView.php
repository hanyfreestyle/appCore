<?php

namespace App\Http\Livewire\Site;

use App\Models\admin\Listing;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class FavoritePageView extends Component
{
    protected $listeners = ['cart_updated'=>'render'];

    public function render(){
        $cart = Cart::content();
        $idList = $cart->pluck('id');
        $listings = Listing::whereIn('id',$idList)->get()->groupBy('listing_type');
//         $listings = Listing::whereIn('id',$idList)->get();
        return view('livewire.site.favorite-page-view',compact('listings'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   removeFromCart
    public function RemoveCard($rowId){
        $cart = Cart::content();
        Cart::remove($cart->where('id',$rowId)->first()->rowId);
        $this->emit('cart_updated');
    }

}
