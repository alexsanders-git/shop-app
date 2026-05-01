<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav id="products" class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><span>Search</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="update-loading" wire:loading wire:target.except="addToCart">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="h3"><span>Search by: <em>{{ $query }}</em></span></h1>

                @if(count($products))
                    <div class="row mt-3">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-sm-6 mb-3" wire:key="{{ $product->id }}">
                                @include('incs.product-card')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ $products->links(data: ['scrollTo' => '#products']) }}
                        </div>
                    </div>
                @else
                    <p>No products found...</p>
                @endif

            </div>
        </div>
    </div>
</div>
