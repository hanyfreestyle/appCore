<?php

namespace App\Http\Livewire;

use App\Models\admin\Listing;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class LoadMoreUnits extends Component{
    public $amount = 5 ;
    public $type;
    public $projectId;
    public $unitId;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   render
    public function render(){
        if($this->type == 'Project'){
            $listings =  Listing::where('listing_type','Unit')
                ->where('parent_id',$this->projectId)
                ->with('translation')
                ->translatedIn()
                ->paginate($this->amount);
        }elseif ($this->type == 'Unit'){
            $listings =  Listing::where('listing_type','Unit')
                ->where('parent_id',$this->projectId)
                ->where('id','!=',$this->unitId)
                ->with('translation')
                ->translatedIn()
                ->paginate($this->amount);
        }

       return view('livewire.load-more-units',compact('listings'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # load
    public function load(){
        $this->amount += 10 ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   addToCart
    public function addToCart($listing_id){
        $listing  = Listing::where('id', $listing_id)->firstOrFail();
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
