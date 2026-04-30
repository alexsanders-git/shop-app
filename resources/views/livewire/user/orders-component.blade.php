<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><a href="{{ route('account') }}" wire:navigate>Account</a></li>
                        <li><span>Orders</span></li>
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

                    <h5 class="section-title"><span>Orders</span></h5>

                    @if($orders->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <th>#</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Details</th>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr wire:key="{{ $order->id }}">
                                        <td>{{ $order->id }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ $order->status ? 'Completed' : 'New' }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                        <td>
                                            <a
                                                href="{{ route('order-detail', $order->id ) }}"
                                                class="btn btn-outline-info"
                                                wire:navigate
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $orders->links() }}
                    @else
                        <h3 class="text-center mt-4">Orders not found...</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
