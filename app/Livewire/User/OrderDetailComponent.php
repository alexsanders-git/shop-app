<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class OrderDetailComponent extends Component
{
    public int $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        $order = Order::query()
            ->where('user_id', '=', auth()->id())
            ->where('id', '=', $this->id)
            ->firstOrFail();

        return view('livewire.user.order-detail-component', [
            'title' => 'Order #' . $order->id,
            'order' => $order,
        ]);
    }
}
