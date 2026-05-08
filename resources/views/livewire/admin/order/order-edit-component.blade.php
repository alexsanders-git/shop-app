<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge badge-info">{{ $order->status ? 'Completed' : 'New' }}</span>
                        <h2>Orders # {{ $order->id }}</h2>
                    </div>

                    <div>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary" wire:navigate>All Orders</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 15%;">ID</th>
                            <td>{{ $order->id }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{ $order->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $order->email }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" wire:model.live="status">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td>{{ \Illuminate\Support\Number::currency($order->total, in: 'USD') }}</td>
                        </tr>

                        <tr>
                            <th>Created</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>

                        <tr>
                            <th>Updated</th>
                            <td>{{ $order->updated_at }}</td>
                        </tr>

                        <tr>
                            <th>Note</th>
                            <td>{{ $order->note }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                Order products
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderProducts as $product)
                            <tr wire:key="{{ $product->id }}">
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" height="50">
                                </td>
                                <td>
                                    <a href="{{ route('product', $product->slug) }}" target="_blank">
                                        {{ $product->title }}
                                    </a>
                                </td>
                                <td>{{ \Illuminate\Support\Number::currency($product->price, in: 'USD') }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ \Illuminate\Support\Number::currency(($product->price * $product->quantity), in: 'USD') }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="5" class="text-right font-weight-bold">
                                Total: {{ \Illuminate\Support\Number::currency($order->total, in: 'USD') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
