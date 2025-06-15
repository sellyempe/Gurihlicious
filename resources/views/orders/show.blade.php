<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] text-[#5F1515] min-h-screen p-6">

    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Detail Pesanan #{{ $order->id }}</h1>

        <div class="mb-6 p-4 bg-white rounded shadow">
            <p><strong>Status:</strong> 
                <span class="px-3 py-1 rounded text-sm
                    {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                       ($order->status == 'paid' ? 'bg-green-200 text-green-800' : 
                       'bg-red-200 text-red-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Nama:</strong> {{ $order->name }}</p>
            <p><strong>Telepon:</strong> {{ $order->phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow mb-6">
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
                    @foreach ($order->items as $item)
                        @php
                            $subtotal = $item->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr class="border-b border-gray-200">
                            <td class="p-3 flex items-center gap-4">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded text-gray-400">No Image</div>
                                @endif
                                <span>{{ $item->product->name }}</span>
                            </td>
                            <td class="p-3 text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">{{ $item->quantity }}</td>
                            <td class="p-3 text-center">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="3" class="p-3 text-right">Total</td>
                        <td class="p-3 text-center">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <a href="{{ route('orders.history') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition">
            Kembali ke Riwayat
        </a>
    </div>

</body>
</html>
