<div class="col-sm-6 mt-2 mt-md-0">
    <div class="search-form">
        <form wire:submit="search">
            <div class="input-group">
                <input type="text" class="form-control" wire:model.live.debounce.500s="term" placeholder="Searching..."
                       aria-label="Searching..." aria-describedby="button-search">
                <button class="btn btn-outline-warning @if(!$term) disabled @endif" type="submit" id="button-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            @if($term)
                <span class="search-clear" x-on:click="$wire.term = ''; $wire.$refresh()">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            @endif
        </form>

        @if(count($search_result))
            <ul class="search-results">
                @foreach($search_result as $product)
                    <li>
                        <a href="{{ route('product', $product->slug) }}" wire:navigate>
                            <span>{{ $product->title }}</span><span>${{ $product->price }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
