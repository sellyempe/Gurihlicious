<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Riwayat Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] text-[#5F1515] min-h-screen p-6">

<header class="absolute inset-x-0 top-0 z-50">
  <nav class="flex items-center justify-between p-6 lg:px-8 border-b-[10px] border-[#5F1515]" aria-label="Global">
    <div class="flex lg:flex-1">
      <a href="#" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        <img class="h-20 w-auto" src="{{ asset('storage/images/logo.png') }}" alt="Logo">
      </a>
    </div>
    <div class="flex lg:hidden">
      <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
      <a href="{{ route('catalog') }}" class="text-sm font-semibold text-gray-900">Produk</a>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4">
        @auth
        <div class="relative inline-block text-left">
          <button id="userMenuButton" class="inline-flex items-center px-5 py-1.5 text-black hover:border-[#1915014a] rounded-sm text-sm leading-normal focus:outline-none space-x-2">
            <span class="font-semibold">Selamat Datang, {{ Auth::user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div id="userDropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
            <div class="py-1">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
              </form>
            </div>
          </div>
        </div>
        @else
        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-white bg-[#5F1515] border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal">Log in</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 text-white bg-[#5F1515] border-[#19140035] hover:border-[#1915014a] border rounded-sm text-sm leading-normal">Register</a>
        @endif
        @endauth
      </nav>
      @endif
    </div>
  </nav>
</header>

<!-- PENTING: padding top di main = tinggi header (p-6 + h-20 logo + border-b 10px) = sekitar 100px -->
<main class="max-w-5xl mx-auto pt-[100px]">
  <h1 class="text-3xl font-bold mb-8 mt-10">Riwayat Pesanan</h1>


  @if(session('success'))
      <div class="mb-6 p-4 bg-green-200 text-green-800 rounded shadow">{{ session('success') }}</div>
  @endif

  @forelse ($orders as $order)
      <div class="bg-white shadow rounded p-6 mb-6 hover:shadow-lg transition">
          <div class="flex justify-between items-center mb-3">
              <h2 class="text-xl font-semibold">Pesanan #{{ $order->id }}</h2>
              <span class="text-sm px-3 py-1 rounded
                  {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                     ($order->status == 'paid' ? 'bg-green-200 text-green-800' : 
                     ($order->status == 'disiapkan' ? 'bg-blue-200 text-blue-800' : 'bg-red-200 text-red-800')) }}">
                  {{ ucfirst($order->status) }}
              </span>
          </div>
          <p class="mb-1"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
          <p class="mb-1"><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
          <p><strong>Alamat:</strong> {{ $order->address }}</p>
      </div>
  @empty
      <p class="text-center text-gray-600 mt-10 text-lg">Belum ada pesanan.</p>
  @endforelse
</main>

<script>
  // Toggle dropdown menu user
  const userMenuButton = document.getElementById('userMenuButton');
  const userDropdown = document.getElementById('userDropdown');

  if (userMenuButton) {
    userMenuButton.addEventListener('click', () => {
      userDropdown.classList.toggle('hidden');
    });

    // Klik di luar dropdown untuk tutup
    document.addEventListener('click', (e) => {
      if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
        userDropdown.classList.add('hidden');
      }
    });
  }
</script>

</body>
</html>
