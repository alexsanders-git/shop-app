<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Dashboard')]
class HomeComponent extends Component
{
    public function render()
    {
        $users_count = User::query()->count();
        $products_count = Product::query()->count();
        $orders_count = Order::query()->count();
        $orders_total = Order::query()->sum('total');

        return view('livewire.admin.home-component', [
            'users_count' => $users_count,
            'products_count' => $products_count,
            'orders_count' => $orders_count,
            'orders_total' => $orders_total,
        ]);
    }
}
