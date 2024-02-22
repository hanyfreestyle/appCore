<?php

namespace App\Http\Livewire\Site;

use App\Models\admin\Listing;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class FavoriteIcon extends Component
{
    public $listing ;
    public $fromwhere = 'card' ;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       render
    public function render(){
        $cart = Cart::content();
        return view('livewire.site.favorite-icon',['cart' => $cart]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   addToCart
    public function addToCart($listing_id){
//        $listing  = Listing::where('id', $listing_id)->firstOrFail();
        $listing  = Listing::where('id', $listing_id)->first();
        Cart::add($listing->id,$listing->name,1,0, ['type' =>$listing->listing_type]);
        $this->emit('cart_updated');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   removeFromCart
    public function removeFromCart($rowId){
        $cart = Cart::content();
        Cart::remove($cart->where('id',$rowId)->first()->rowId);
        $this->emit('cart_updated');
    }

}
