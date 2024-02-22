<div>
    @if($fromwhere == 'card')
        <span wire:loading.remove>
            @if($cart->where('id', $listing->id)->count() == '0')
                <form  wire:loading.remove wire:submit.prevent="addToCart({{$listing->id}})" method="post">
            <button type="submit" class="property-card__fav w-10 h-10 rounded-circle bg-neutral-0 d-grid place-content-center border-0 clr-primary-300">
                <i class="fa-regular fa-heart card__heart_unactive"></i>
            </button>
        </form>
            @else
                <form  wire:loading.remove wire:submit.prevent="removeFromCart({{$listing->id}})" method="post">
            <button type="submit" class="property-card__fav w-10 h-10 rounded-circle bg-danger d-grid place-content-center border-0 clr-primary-300">
                <i class="fa-regular fa-heart card__heart_active"></i>
            </button>
        </form>
            @endif
    </span>
    @elseif($fromwhere == 'ListView')
        <div wire:loading.remove>
            @if($cart->where('id', $listing->id)->count() == '0')
                <form  wire:loading.remove wire:submit.prevent="addToCart({{$listing->id}})" method="post">
                    <li>
                        <button type="submit" class="social_favorite">
                            <i class="fas fa-heart"></i>
                        </button>
                    </li>
                </form>
            @else
                <form  wire:loading.remove wire:submit.prevent="removeFromCart({{$listing->id}})" method="post">
                    <li>
                        <button type="submit" class="social_favorite social_favorite_active">
                            <i class="fas fa-heart"></i>
                        </button>
                    </li>
                </form>
            @endif
        </div>
    @endif
</div>
