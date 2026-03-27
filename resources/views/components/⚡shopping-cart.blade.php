<?php

use Livewire\Component;
use Livewire\Attributes\Title;

// Anda bisa langsung menyematkan Title di anonymous class ini
new #[Title('Keranjang Belanja')] class extends Component
{
    public array $products = [];
    public array $cart = [];
    public int $totalPrice = 0;

    public function mount(): void
    {
        // Simulasi data produk
        $this->products = [
            ['id' => 1, 'name' => 'Lisensi Antivirus 1 Tahun', 'price' => 150000],
            ['id' => 2, 'name' => 'Kabel Data Type-C', 'price' => 35000],
            ['id' => 3, 'name' => 'Flashdisk 32GB', 'price' => 65000],
        ];
    }

    public function addToCart(int $productId): void
    {
        $product = collect($this->products)->firstWhere('id', $productId);

        if ($product) {
            $cartIndex = collect($this->cart)->search(fn($item) => $item['id'] === $productId);

            if ($cartIndex !== false) {
                $this->cart[$cartIndex]['qty']++;
            } else {
                $this->cart[] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'qty' => 1,
                ];
            }
            $this->calculateTotal();
        }
    }

    public function decrementQty(int $productId): void
    {
        $cartIndex = collect($this->cart)->search(fn($item) => $item['id'] === $productId);

        if ($cartIndex !== false) {
            if ($this->cart[$cartIndex]['qty'] > 1) {
                $this->cart[$cartIndex]['qty']--;
            } else {
                // Hapus item dari array jika qty mencapai 0
                unset($this->cart[$cartIndex]);
                // Re-index array agar tidak ada celah key di JavaScript/Livewire
                $this->cart = array_values($this->cart);
            }
            $this->calculateTotal();
        }
    }

    private function calculateTotal(): void
    {
        $this->totalPrice = collect($this->cart)->sum(fn($item) => $item['price'] * $item['qty']);
    }

    public function checkout(): void
    {
        // Logika simpan ke database (Order & OrderItem) bisa diletakkan di sini
        
        session()->flash('success', 'Checkout berhasil diproses!');
        $this->cart = [];
        $this->totalPrice = 0;
    }
};
?>

<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <h4 class="mb-3">Katalog Produk</h4>
            <div class="row g-3">
                @foreach($products as $product)
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $product['name'] }}</h5>
                                <p class="card-text text-primary fs-5 mb-4">
                                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                                </p>
                                <button wire:click="addToCart({{ $product['id'] }})" class="btn btn-outline-primary mt-auto">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="mb-0">Ringkasan Belanja</h4>
                </div>
                <div class="card-body">
                    
                    @if(empty($cart))
                        <div class="text-center py-5 text-muted">
                            <h1 class="display-4">🛒</h1>
                            <p>Keranjang Anda masih kosong</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush mb-4">
                            @foreach($cart as $item)
                                <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                                    <div class="me-auto">
                                        <h6 class="mb-1 fw-bold">{{ $item['name'] }}</h6>
                                        <div class="text-muted small">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2">
                                        <button wire:click="decrementQty({{ $item['id'] }})" class="btn btn-sm btn-light border">-</button>
                                        <span class="fw-bold" style="width: 20px; text-align: center;">{{ $item['qty'] }}</span>
                                        <button wire:click="addToCart({{ $item['id'] }})" class="btn btn-sm btn-light border">+</button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="bg-light p-3 rounded-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 text-muted">Total Bayar</span>
                            <span class="fs-4 fw-bold text-primary">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button 
                        wire:click="checkout" 
                        class="btn btn-primary w-100 py-2 fs-5 {{ empty($cart) ? 'disabled' : '' }}"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading wire:target="checkout" class="spinner-border spinner-border-sm me-2" role="status"></span>
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>