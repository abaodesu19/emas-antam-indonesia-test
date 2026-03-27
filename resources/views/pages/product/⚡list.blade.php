<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component
{
    public $produk = [];
    public $cart = [];

    public function mount()
    {
        $this->produk = Product::all();
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if (! $product) {
            return;
        }

        $item = $this->cart[$id] ?? [
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 0,
            'total' => 0,
        ];
        $item['qty']++;
        $item['total'] = $item['price'] * $item['qty'];
        $this->cart[$id] = $item;
    }

    public function minusToCart($id)
    {
        $item = $this->cart[$id];
        if (! $item) {
            return;
        }

        if ($item['qty'] <= 1) {
            unset($this->cart[$id]);
            return;
        }

        $item['qty']--;
        $item['total'] = $item['price'] * $item['qty'];
        $this->cart[$id] = $item;
    }

    public function removeCart($id)
    {
        unset($this->cart[$id]);
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6">
        <img src="https://emasantam.id/wp-content/uploads/2021/09/Logo-EAI-Baru-Warna.svg" alt="Logo EAI" class="w-48">
    </h1>
    <div class='grid grid-cols-3 gap-6'>
        <div class="col-span-2">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($this->produk as $i)
                    <div class="rounded-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gray-200 aspect-square">
                            <img src="https://sobatemas.com/product/img_xgHyJW0.jpg" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <div class="text-sm text-gray-600">{{ $i->name }}</div>
                            <div class="text-sm text-gray-600 font-bold">Rp {{ number_format($i->price, 2, '.', ',') }}</div>
                            <button wire:click="addToCart({{ $i->id }})" class="mt-3 w-full rounded-md bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-700 active:bg-emerald-800">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            @if (count($this->cart) > 0)
                <h2 class="text-lg font-semibold mb-4">Keranjang</h2>
                <div class="space-y-4">
                    @foreach ($this->cart as $i)
                    <div class="flex items-center gap-3">
                        <div class="w-16 h-16 bg-gray-200 rounded">
                            <img src="https://sobatemas.com/product/img_xgHyJW0.jpg" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium">{{ $i['name'] }}</div>
                            <div class="mt-1 flex items-center gap-2">
                                <button wire:click="minusToCart({{ $i['id'] }})" class="h-7 w-7 flex items-center justify-center rounded border border-gray-300 text-gray-700 hover:bg-gray-50">-</button>
                                <div class="w-8 text-center text-sm">{{ $i['qty'] }}</div>
                                <button wire:click="addToCart({{ $i['id'] }})" class="h-7 w-7 flex items-center justify-center rounded border border-gray-300 text-gray-700 hover:bg-gray-50">+</button>
                            </div>
                        </div>
                        <div class="text-sm font-semibold">Rp {{ number_format($i['total'], 2, '.', ',') }}</div>
                        <button wire:click="removeCart({{ $i['id'] }})" class="h-8 w-8 flex items-center justify-center rounded hover:bg-red-50" aria-label="Hapus">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5 text-red-600">
                                <path d="M3 6h18"></path>
                                <path d="M8 6V4h8v2"></path>
                                <path d="M19 6l-1 14H6L5 6"></path>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 border-t border-t-gray-200 pt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Total harga keseluruhan</div>
                    <div class="text-base font-semibold">Rp {{ number_format(array_sum(array_column($this->cart, 'total')), 2, '.', ',') }}</div>
                </div>
            @else
                <div class="text-center text-gray-600">Keranjang Anda kosong</div>
            @endif
        </div>
    </div>
</div>
