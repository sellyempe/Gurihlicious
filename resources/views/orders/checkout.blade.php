<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen p-6 text-[#5F1515]">

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">Checkout Pesanan</h1>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-200 text-red-800 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
    <table class="w-full border border-gray-300 rounded mb-8 bg-white">
        <thead class="bg-[#5F1515] text-white">
            <tr>
                <th class="p-3 text-left">Produk</th>
                <th class="p-3 text-center">Harga</th>
                <th class="p-3 text-center">Jumlah</th>
                <th class="p-3 text-center">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($products as $product)
                @php
                    $qty = $cart[$product->id];
                    $subtotal = $product->price * $qty;
                    $total += $subtotal;
                @endphp
                <tr class="border-b border-gray-300">
                    <td class="p-3 flex items-center gap-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded" />
                        @else
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded text-gray-400">No Image</div>
                        @endif
                        <span>{{ $product->name }}</span>
                    </td>
                    <td class="p-3 text-center">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="p-3 text-center">{{ $qty }}</td>
                    <td class="p-3 text-center font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="font-bold bg-gray-100">
                <td colspan="3" class="p-3 text-right">Total</td>
                <td class="p-3 text-center">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h2 class="text-xl font-semibold mb-4">Data Pemesan</h2>
    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        <div>
            <label for="name" class="block font-semibold mb-1">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="w-full border border-gray-300 rounded p-2" />
        </div>
        <div>
            <label for="phone" class="block font-semibold mb-1">Nomor Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                class="w-full border border-gray-300 rounded p-2" />
        </div>
        <div>
            <label for="address" class="block font-semibold mb-1">Alamat Lengkap</label>
            <textarea id="address" name="address" rows="4" required
                class="w-full border border-gray-300 rounded p-2 resize-none">{{ old('address') }}</textarea>
        </div>

        <button type="submit" class="bg-[#5F1515] text-white py-3 px-6 rounded hover:bg-[#7a1c1c] transition">
            Buat Pesanan & Lanjutkan ke Pembayaran
        </button>
    </form>
</div>

</body>
</html>
