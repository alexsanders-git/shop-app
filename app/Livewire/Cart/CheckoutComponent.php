<?php

namespace App\Livewire\Cart;

use App\Helpers\Cart\Cart;
use App\Mail\OrderClient;
use App\Mail\OrderManager;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public string $name;
    public string $email;
    public string $note;

    public function mount()
    {
        $this->name = auth()->user()->name ?? '';
        $this->email = auth()->user()->email ?? '';
    }

    public function saveOrder()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'note' => 'string|nullable',
        ]);

        $validated = array_merge($validated, [
            'user_id' => auth()->id(),
            'total' => Cart::getCartTotal(),
        ]);

        try {
            DB::beginTransaction();
            $order = Order::create($validated);
            $order_products = [];
            $cart = Cart::getCart();

            foreach ($cart as $id => $item) {
                $order_products[] = [
                    'product_id' => $id,
                    'title' => $item['title'],
                    'slug' => $item['slug'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'image' => $item['image'],
                ];
            }

            $order->orderProducts()->createMany($order_products);

            // Mail::to($validated['email'])->send(new OrderClient($order_products, Cart::getCartTotal(), $order->id, $validated['note']));
            // Mail::to('admin@shop-app.com')->send(new OrderManager($order->id));

            Cart::clearCart();
            $this->dispatch('cart-updated');

            $this->js("toastr.success('Order created')");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error on saving order')");
        }
    }

    public function render()
    {
        return view('livewire.cart.checkout-component');
    }
}
