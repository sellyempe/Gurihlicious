<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Produk</h2>

    @if ($errors->any())
      <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf
      @method('PUT')

      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Stok / Berat</label>
        <input type="text" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
        <textarea name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Gambar Produk (opsional)</label>
        <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
      </div>

      <div class="text-center">
        <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700 transition duration-300">
          Update Produk
        </button>
      </div>
    </form>
  </div>

</body>
</html>
