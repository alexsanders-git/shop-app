<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2>Orders List</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th style="width: 10%;">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($orders as $key => $order)
                            <tr wire:key="{{ $order->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->status ? 'Completed' : 'New' }}</td>
                                <td>{{ \Illuminate\Support\Number::currency($order->total, in: 'USD') }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                       class="btn btn-info"
                                       wire:navigate>
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button
                                        class="btn btn-danger"
                                        wire:click="deleteOrder({{ $order->id }})"
                                        wire:confirm="Are you sure?"
                                        wire:loading.attr="disabled"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
