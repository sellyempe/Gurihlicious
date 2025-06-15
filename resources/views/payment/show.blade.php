<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pembayaran Pesanan #{{ $order->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen p-6 text-[#5F1515]">

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Pembayaran Pesanan #{{ $order->id }}</h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="mb-6 border p-4 rounded bg-white shadow">
        <h2 class="text-xl font-semibold mb-2">Detail Pesanan</h2>
        <p><strong>Nama:</strong> {{ $order->name }}</p>
        <p><strong>Telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Alamat:</strong> {{ $order->address }}</p>
    </div>

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
            @foreach ($order->items as $item)
                @php
                    $subtotal = $item->price * $item->quantity;
                    $total += $subtotal;
                @endphp
                <tr class="border-b border-gray-300">
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
                    <td class="p-3 text-center font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="font-bold bg-gray-100">
                <td colspan="3" class="p-3 text-right">Total</td>
                <td class="p-3 text-center">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
   
    <form id="payment-form" method="POST">
    @csrf

    <!-- Tabel detail pesanan ... sudah ada di kode kamu -->

    <button type="button" id="pay-button" class="bg-[#5F1515] text-white py-3 px-6 rounded hover:bg-[#7a1c1c] transition">Bayar</button>
</form>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            // Update status order ke 'disiapkan' via AJAX
            fetch("{{ route('orders.markPrepared', $order->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                alert("Pembayaran berhasil! Status diperbarui menjadi disiapkan.");
                window.location.href = "{{ route('orders.history') }}";
            })
            .catch(error => {
                alert("Pembayaran berhasil, tapi gagal memperbarui status.");
                window.location.href = "{{ route('orders.history') }}";
            });
        },
        onPending: function(result){
            alert("Pembayaran masih dalam proses.");
        },
        onError: function(result){
            alert("Terjadi kesalahan saat pembayaran.");
        },
        onClose: function(){
            alert("Kamu menutup popup pembayaran.");
        }
    });
});

</script>


</body>
</html>
