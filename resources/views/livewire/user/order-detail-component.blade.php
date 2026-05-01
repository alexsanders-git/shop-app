<div>
    @section('meta')
        <title>{{ config('app.name'). ' | ' . ($title ?? 'Page') }}</title>
    @endsection
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><a href="{{ route('account') }}" wire:navigate>Account</a></li>
                        <li><a href="{{ route('orders') }}" wire:navigate>Orders</a></li>
                        <li><span>Order Details</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="cart-summary p-3 sidebar">
                    @include('incs.account-links')
                </div>
            </div>

            <div class="col-lg-8 mb-3">
                <div class="cart-content p-3 h-100 bg-white position-relative">
                    <div class="update-loading" wire:loading>
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <h5 class="section-title"><span>Order #{{ $order->id }}</span></h5>

                    @if($order->note)
                        <div class="alert alert-info" role="alert">
                            <strong>Note: </strong>
                            {{ $order->note }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <th>Photo</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            </thead>
                            <tbody>
                            @foreach($order->orderProducts as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <td class="product-img-td">
                                        <a href="{{ route('product', $product->slug) }}" wire:navigate>
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('product', $product->slug) }}" class="cart-content-title"
                                           wire:navigate>
                                            {{ $product->title }}
                                        </a>
                                    </td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>${{ $product->price * $product->quantity }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-end">
                                    <h4>
                                        Total: {{ \Illuminate\Support\Number::currency($order->total, in: 'USD') }}
                                    </h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
