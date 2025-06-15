<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Produk - Gurihlicious</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] min-h-screen p-6 text-[#5F1515]">

<header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8 border-b-[10px] border-[#5F1515]" aria-label="Global">

    <div class="flex lg:flex-1">
      <a href="{{ route('dashboard') }}" class="-m-1.5 p-1.5">
        <span class="sr-only">Gurihlicious</span>
        <img class="h-20 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo">
      </a>
    </div>

    

    <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center gap-6">
    <div class="relative">
    @php
    $cart = session()->get('cart', []);
    $cartCount = $cart ? array_sum($cart) : 0;
@endphp



<a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-red-600 transition">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
  </svg>

  @if($cartCount > 0)
    <span class="absolute -top-1 -right-2 bg-red-600 text-white text-sm font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg">
      {{ $cartCount }}
    </span>
  @endif
</a>

      </div>
      @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4">
        @auth
        <div class="relative inline-block text-left">
          <button id="userMenuButton"
            class="inline-flex items-center px-5 py-1.5 text-black hover:border-[#1915014a] rounded-sm text-sm leading-normal focus:outline-none space-x-2">
            <span class="font-semibold">Selamat Datang, {{ Auth::user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div id="userDropdown"
            class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
            <div class="py-1">
              <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
              <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
              </form>
            </div>
          </div>
        </div>
        @else
        <a href="{{ route('login') }}"
          class="inline-block px-5 py-1.5 text-white bg-[#5F1515] border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal">Log
          in</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}"
          class="inline-block px-5 py-1.5 text-white bg-[#5F1515] border-[#19140035] hover:border-[#1915014a] border rounded-sm text-sm leading-normal">
          Register
        </a>
        @endif
        @endauth
      </nav>
      @endif
      
    </div>

    {{-- Mobile menu button --}}
    <div class="flex lg:hidden">
      <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>

  </nav>
</header>

<div class="mt-36 max-w-7xl mx-auto px-4 text-center">
    <h1 class="text-4xl font-bold">Produk Gurihlicious</h1>
    <p class="mt-2 text-gray-700">Pilih produk terbaik untuk kebutuhanmu.</p>
</div>

<main class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 max-w-7xl mx-auto px-4 mt-6">
    @forelse ($products as $product)
        <div class="bg-white rounded-lg shadow p-6 flex flex-col h-full">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mb-6 h-64 w-full object-cover rounded">
            @else
                <div class="mb-6 h-64 w-full bg-gray-200 flex items-center justify-center rounded text-gray-400">
                    Tidak ada gambar
                </div>
            @endif

            <h2 class="text-xl font-semibold mb-3">{{ $product->name }}</h2>
            <p class="text-gray-700 mb-6 flex-grow">{{ Str::limit($product->description ?? 'Deskripsi tidak tersedia.', 120) }}</p>
            <div class="text-lg font-bold mb-4">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>

            <div class="flex gap-3 mt-auto">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow">
                    @csrf
                    <button type="submit" 
                        class="w-full bg-[#5F1515] text-white py-2 rounded hover:bg-[#E5D0AC] transition">
                        Tambah
                    </button>
                </form>
                <a href="{{ route('products.show', $product->id) }}" 
                   class="flex-grow text-center border border-[#5F1515] text-[#5F1515] py-2 rounded hover:bg-[#E5D0AC] hover:text-white transition">
                   Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <p class="col-span-full text-center text-gray-500">Maaf, belum ada produk tersedia.</p>
    @endforelse
</main>

<div class="mt-8 max-w-7xl mx-auto px-4">
    {{ $products->links() }}
</div>

<script>
    // Toggle user dropdown menu
    document.getElementById('userMenuButton')?.addEventListener('click', function() {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userMenuButton');
        if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>
