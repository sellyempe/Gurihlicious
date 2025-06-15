<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk - {{ $product->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#FEF9E1] min-h-screen pt-36 flex items-center justify-center p-6">

  {{-- Navbar --}}
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
      </div>

      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
    </nav>
  </header>

  {{-- Konten Detail Produk --}}
  <main class="mt-16 max-w-xl bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center space-y-6">
    @if($product->image)
      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
           class="w-full h-80 object-cover rounded-xl shadow-md">
    @else
      <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-xl text-gray-400 text-lg font-semibold">
        Gambar tidak tersedia
      </div>
    @endif

    <h1 class="text-3xl font-extrabold text-[#5F1515] text-center">{{ $product->name }}</h1>

    <p class="text-gray-700 text-center leading-relaxed">
      {{ $product->description ?? 'Deskripsi produk tidak tersedia.' }}
    </p>

    <div class="text-xl font-semibold text-[#5F1515]">
      Harga: Rp {{ number_format($product->price, 0, ',', '.') }}
    </div>

    <div class="text-md text-gray-600">
      Stok : <span class="font-medium">{{ $product->stock }}</span>
    </div>

    {{-- Form Tambah ke Keranjang --}}
    <div class="w-full flex space-x-4 mt-4">
      <form method="POST" action="{{ route('cart.add', $product->id) }}" class="w-full">
        @csrf
        <button type="submit"
                class="w-full py-3 px-6 rounded-xl bg-[#5F1515] text-white font-semibold hover:bg-[#7a1c1c] transition">
          Tambah ke Keranjang
        </button>
      </form>

      <a href="{{ route('catalog') }}" 
         class="flex-1 py-3 px-6 rounded-xl border border-[#5F1515] text-[#5F1515] font-semibold text-center hover:bg-[#5F1515] hover:text-white transition">
        Kembali
      </a>
    </div>
  </main>

  {{-- JS Dropdown --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const userMenuButton = document.getElementById('userMenuButton');
      const userDropdown = document.getElementById('userDropdown');

      if (userMenuButton) {
        userMenuButton.addEventListener('click', function (e) {
          e.stopPropagation();
          userDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function () {
          userDropdown.classList.add('hidden');
        });

        userDropdown.addEventListener('click', function (e) {
          e.stopPropagation();
        });
      }
    });
  </script>

</body>
</html>
