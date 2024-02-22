<div>
    <p class="mb-3 clr-neutral-30 newsletter_text">{!! __('web/newsletter.text') !!}</p>
    @if (session()->has('SaveToNewsLetter'))
        <div class="newsletter_confirm">
            {{ session('SaveToNewsLetter') }}
        </div>
    @else
        <div class="p-2 rounded-pillX border border-neutral-200">
            <form wire:submit.prevent="addNew" class="d-flex align-items-center">
                @csrf
                <input type="text" wire:model="email" placeholder="{{__('web/newsletter.email')}}" class="newsletter_input w-100 border-0 bg-transparent clr-neutral-30 px-3 py-2 ">
                <button type="submit" class="d-grid place-content-center px-6 py-3 rounded-pill bg-tertiary-300 clr-neutral-0 border-0">
                    <i class="fa-regular fa-paper-plane"></i>
                </button>
            </form>

        </div>
        <div class="newsletter_error">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
    @endif

</div>
