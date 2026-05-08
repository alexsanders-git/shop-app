<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading wire:target="save">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary" wire:navigate>
                    All Users
                </a>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="name" class="form-label required">Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            placeholder="Name"
                            wire:model="name"
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
                        >
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label required">Password</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            placeholder="Password"
                            wire:model="password"
                        >
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    @if(auth()->id() !== $user->id)
                        <div class="mb-3">
                            <p>Is Admin?</p>
                            <label class="switch">
                                <input type="checkbox" wire:model="is_admin">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    @endif

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary d-flex">
                            Save

                            <div class="ml-2" wire:loading wire:target="save">
                                <div class="spinner-grow spinner-grow-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($user_orders->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">User Orders</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($user_orders as $order)
                                <tr wire:key="{{ $order->id }}">
                                    <td>{{ $order->id }}</td>
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $user_orders->links(data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
