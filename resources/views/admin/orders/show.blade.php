<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Pesanan #{{ $order->id }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen flex items-center justify-center">

<header class="mb-8 flex justify-between items-center">
  <h1 class="text-3xl font-bold text-[#5F1515]">Detail Pesanan #{{ $order->id }}</h1>
  <a href="{{ route('orders.index') }}" class="text-[#5F1515] hover:underline">Kembali ke Daftar Pesanan</a>
</header>

<div class="max-w-4xl mx-auto bg-white rounded shadow p-6">

  <section class="mb-6">
    <h2 class="text-xl font-semibold mb-3 text-[#5F1515]">Informasi Pemesan</h2>
    <p><strong>Nama:</strong> {{ $order->user->name ?? 'Tidak diketahui' }}</p>
    <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
    <p><strong>Alamat Pengiriman:</strong> {{ $order->address }}</p>
    <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
    <p>
      <strong>Status:</strong>
      <span class="px-2 py-1 rounded
        {{ $order->status == 'dikemas' ? 'bg-yellow-200 text-yellow-800' : '' }}
        {{ $order->status == 'dikirim' ? 'bg-blue-200 text-blue-800' : '' }}
        {{ $order->status == 'selesai' ? 'bg-green-200 text-green-800' : '' }}
        {{ !in_array($order->status, ['dikemas','dikirim','selesai']) ? 'bg-red-200 text-red-800' : '' }}
      ">
        {{ ucfirst($order->status) }}
      </span>
    </p>
  </section>

  <section>
    <h2 class="text-xl font-semibold mb-3 text-[#5F1515]">Detail Produk</h2>
    @if($order->items && $order->items->count())
      <table class="min-w-full divide-y divide-gray-200 mb-4">
        <thead class="bg-[#5F1515] text-white">
          <tr>
            <th class="py-2 px-4 text-left">Produk</th>
            <th class="py-2 px-4 text-left">Jumlah</th>
            <th class="py-2 px-4 text-left">Harga Satuan</th>
            <th class="py-2 px-4 text-left">Subtotal</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach ($order->items as $item)
          <tr>
            <td class="py-2 px-4">{{ $item->product->name ?? 'Produk tidak ditemukan' }}</td>
            <td class="py-2 px-4">{{ $item->quantity }}</td>
            <td class="py-2 px-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td class="py-2 px-4">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-right font-semibold text-lg">
        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
      </div>
    @else
      <p class="text-gray-600">Tidak ada item dalam pesanan ini.</p>
    @endif
  </section>

</div>

</body>
</html>
