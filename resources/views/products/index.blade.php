<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelola Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen p-6">

    <header class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-[#5F1515]">Kelola Produk</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-[#5F1515] underline hover:text-[#7a1c1c]">Kembali ke Dashboard</a>
    </header>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}" class="mb-6 inline-block bg-[#5F1515] text-white px-4 py-2 rounded hover:bg-[#7a1c1c]">Tambah Produk Baru</a>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-[#5F1515] text-white">
            <tr>
                <th class="text-left py-3 px-4">Nama</th>
                <th class="text-left py-3 px-4">Harga</th>
                <th class="text-left py-3 px-4">Stok</th>
                <th class="text-left py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-4">{{ $product->name }}</td>
                <td class="py-3 px-4">Rp. {{ number_format($product->price,0,',','.') }}</td>
                <td class="py-3 px-4">{{ $product->stock }}</td>
                <td class="py-3 px-4 flex gap-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4">Tidak ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</body>
</html>
