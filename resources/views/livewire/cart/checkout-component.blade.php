<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        @if($cart = \App\Helpers\Cart\Cart::getCart())
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="Checkout p-3 h-100 bg-white">
                        <h1 class="section-title h5"><span>Checkout</span></h1>

                        <form wire:submit="saveOrder">
                            @guest
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        placeholder="Name"
                                        wire:model="name"
                                        required
                                    >
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label required">Email</label>
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        placeholder="Email"
                                        wire:model="email"
                                        required
                                    >
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            @endguest

                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea
                                    class="form-control @error('note') is-invalid @enderror"
                                    id="note"
                                    rows="5"
                                    placeholder="Note to order..."
                                    wire:model="note"
                                ></textarea>
                                @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-warning">
                                    Checkout

                                    <div wire:loading wire:target="saveOrder">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class="cart-summary p-3 sidebar">
                        <h5 class="section-title"><span>Cart Summary</span></h5>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $id => $item)
                                    <tr wire:key="{{ $id }}">
                                        <td>
                                            {{ $item['title'] }}
                                            <small>(${{ $item['price'] }}) x {{ $item['quantity'] }}</small>
                                        </td>
                                        <td class="text-end">${{ $item['quantity'] * $item['price'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end">
                                        {{ \Illuminate\Support\Number::currency(\App\Helpers\Cart\Cart::getCartTotal(), in: 'USD') }}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h3 class="text-center mt-4">Cart is empty...</h3>
        @endif
    </div>
</div>
