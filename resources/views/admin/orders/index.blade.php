<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kelola Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen">

  <div class="max-w-7xl mx-auto px-4 py-10">
    
    <!-- Header -->
    <header class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      <h1 class="text-3xl font-bold text-[#5F1515]">Kelola Pesanan</h1>
      <a href="{{ route('dashboard') }}" class="text-[#5F1515] hover:underline text-base">Kembali ke Dashboard</a>
    </header>

    <!-- Flash Message -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-200 text-green-800 rounded shadow">
        {{ session('success') }}
      </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#5F1515] text-white">
          <tr>
            <th class="py-3 px-6 text-left font-semibold">ID Pesanan</th>
            <th class="py-3 px-6 text-left font-semibold">Nama Pemesan</th>
            <th class="py-3 px-6 text-left font-semibold">Tanggal</th>
            <th class="py-3 px-6 text-left font-semibold">Total</th>
            <th class="py-3 px-6 text-left font-semibold">Status</th>
            <th class="py-3 px-6 text-left font-semibold">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach ($orders as $order)
          <tr class="hover:bg-gray-50">
            <td class="py-3 px-6 whitespace-nowrap">{{ $order->id }}</td>
            <td class="py-3 px-6 whitespace-nowrap">{{ $order->user->name ?? '-' }}</td>
            <td class="py-3 px-6 whitespace-nowrap">{{ $order->created_at->format('d M Y, H:i') }}</td>
            <td class="py-3 px-6 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td class="py-3 px-6 whitespace-nowrap">
              <form action="{{ route('orders.update', $order->id) }}" method="POST" class="flex items-center space-x-2">
                @csrf
                @method('PUT')
                <select name="status" class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-[#5F1515]">
                  <option value="dikemas" {{ $order->status == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                  <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                  <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" 
                        class="bg-[#5F1515] hover:bg-[#7a1c1c] text-white text-sm px-3 py-1 rounded transition">
                  Update
                </button>
              </form>
            </td>
            <td class="py-3 px-6 whitespace-nowrap">
              <a href="{{ route('orders.show', $order->id) }}" 
                 class="text-[#5F1515] hover:underline text-sm font-medium">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $orders->links() }}
    </div>

  </div>

</body>
</html>
