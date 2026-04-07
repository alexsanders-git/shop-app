<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class HomeComponent extends Component
{
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

        return view( 'livewire.home-component', [
            'hit_products' => $hit_products,
            'new_products' => $new_products,
        ] );
    }
}
