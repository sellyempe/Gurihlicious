<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Keranjang Belanja - Gurihlicious</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen p-6 text-[#5F1515]">

<div class="max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold mb-8">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-200 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    @if(empty($cart) || count($cart) === 0)
        <p>Keranjang belanja kosong.</p>
        <a href="{{ route('catalog') }}" 
           class="inline-block mt-4 py-3 px-6 rounded-xl border border-[#5F1515] text-[#5F1515] font-semibold hover:bg-[#5F1515] hover:text-white transition">
           Kembali ke Produk
        </a>
    @else
        <table class="w-full border border-gray-300 rounded mb-8">
            <thead class="bg-[#5F1515] text-white">
                <tr>
                    <th class="p-3 text-left">Produk</th>
                    <th class="p-3 text-center">Harga</th>
                    <th class="p-3 text-center">Jumlah</th>
                    <th class="p-3 text-center">Subtotal</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($products as $product)
                    @php
                        $qty = $cart[$product->id] ?? 0;
                        $subtotal = $product->price * $qty;
                        $total += $subtotal;
                    @endphp
                    <tr class="border-b border-gray-300">
                        <td class="p-3 flex items-center gap-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded">
                            @else
                                <div class="w-20 h-20 bg-gray-200 flex items-center justify-center rounded text-gray-400">No Image</div>
                            @endif
                            <span>{{ $product->name }}</span>
                        </td>
                        <td class="p-3 text-center">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="flex justify-center update-form" novalidate>
                                @csrf
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="{{ $qty }}" 
                                    class="w-16 text-center rounded border border-gray-300 quantity-input"
                                    data-stock="{{ $product->stock }}"
                                    data-product="{{ $product->name }}"
                                />
                                <button type="submit" class="ml-2 bg-[#5F1515] text-white px-3 rounded hover:bg-[#7a1c1c] transition">
                                    Update
                                </button>
                            </form>
                        </td>
                        <td class="p-3 text-center font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="font-bold bg-gray-100">
                    <td colspan="3" class="p-3 text-right">Total</td>
                    <td class="p-3 text-center">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-between items-center">
            <a href="{{ route('catalog') }}" 
               class="py-3 px-6 rounded-xl border border-[#5F1515] text-[#5F1515] font-semibold hover:bg-[#5F1515] hover:text-white transition">
               Lanjut Belanja
            </a>

            <a href="{{ route('checkout') }}" 
               class="py-3 px-6 rounded-xl bg-[#5F1515] text-white font-semibold hover:bg-[#7a1c1c] transition">
               Checkout
            </a>
        </div>
    @endif
</div>

<!-- SCRIPT VALIDASI -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const updateForms = document.querySelectorAll('.update-form');

        updateForms.forEach(form => {
            form.addEventListener('submit', e => {
                const input = form.querySelector('.quantity-input');
                const stock = parseInt(input.dataset.stock);
                const quantity = parseInt(input.value);
                const product = input.dataset.product;

                if (quantity > stock) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jumlah Melebihi Stok!',
                        text: `Stok untuk "${product}" hanya tersedia ${stock}.`,
                        confirmButtonColor: '#5F1515'
                    });
                } else if (quantity < 1) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jumlah Tidak Valid',
                        text: 'Jumlah produk minimal 1.',
                        confirmButtonColor: '#5F1515'
                    });
                }
            });
        });
    });
</script>

</body>
</html>
