<?php

namespace App\Livewire;

use App\Helpers\Traits\CartTrait;
use Livewire\Component;
use App\Models\Product;

class HomeComponent extends Component
{
    use CartTrait;

    public function render()
    {
        $hit_products = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_hit', '=', 1)
            ->limit(4)
            ->get();

        $new_products = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_new', '=', 1)
            ->limit(8)
            ->get();

        return view('livewire.home-component', [
            'title' => 'Home',
            'hit_products' => $hit_products,
            'new_products' => $new_products,
        ]);
    }
}
