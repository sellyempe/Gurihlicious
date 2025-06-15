<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gurih</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#FEF9E1] text-[#5F1515]">

  <!-- Navbar -->
  <header class="border-b-[10px] border-[#5F1515]">
    <nav class="flex justify-between items-center px-6 py-4">
      <a href="#">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Gurihlicious Logo" class="h-20 w-auto">
      </a>
      <div class="hidden md:flex gap-6 items-center">
        @if (Route::has('login'))
          @auth
          <div class="relative group">
            <button class="flex items-center gap-2 px-4 py-2 border rounded text-sm cursor-pointer">
              <span>{{ Auth::user()->name }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white text-black rounded-md shadow-lg z-50">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
              <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Riwayat Pesanan</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Keluar</button>
              </form>
            </div>
          </div>
          @else
          <a href="{{ route('login') }}" class="px-8 py-4 bg-[#5F1515] text-white rounded text-base hover:bg-[#a67c52] border border-white rounded-full">Masuk</a>
          @if (Route::has('register'))
          <a href="{{ route('register') }}" class="px-8 py-4 bg-[#5F1515] text-white rounded text-base hover:bg-[#a67c52] border border-white rounded-full">Daftar</a>
          @endif
          @endauth
        @endif
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="text-center py-20 px-4">
    <h1 class="text-6xl md:text-8xl font-semibold mb-6 pt-4">Selamat Datang!</h1>
    <p class="text-4xl md:text-5xl max-w-2xl mx-auto pt-10">"Kami menghadirkan makanan dengan bahan berkualitas, cita rasa autentik, dan proses pembuatan yang higenis. Pesan sekarang dan rasakan kelezatannya!"</p>
  </section>

  <!-- Best Seller -->
  <section class="py-16 px-4">
    <h2 class="text-6xl font-bold text-center mb-12 pt-20">BEST SELLER</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 justify-items-center">
      @foreach ([
        ['nama' => 'Abon Tuna Pedas', 'img' => 'abon_tuna.png'],
        ['nama' => 'Abon Ayam', 'img' => 'abon_ayam.png'],
        ['nama' => 'Abon Sapi', 'img' => 'abon_sapi.png'],
        ['nama' => 'Dendeng', 'img' => 'dendeng.png']
      ] as $produk)
      <a href="{{ route('login') }}" class="group no-underline">
      <div class="group bg-[#E0CDA9] rounded-3xl p-6 shadow-md text-center relative w-60 transition-shadow duration-300 hover:shadow-[0_6px_20px_#5F1515] cursor-pointer pb-15">
        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-[#5F1515] text-white px-4 py-1 rounded-full text-lg">
          {{ $produk['nama'] }}
        </div>
        <img src="{{ asset('storage/images/' . $produk['img']) }}" alt="{{ $produk['nama'] }}" class="w-full h-auto mt-8 rounded">
        <p class="mt-4 text-2xl font-bold text-[#5D4037]">Rp 25.000</p>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer-container pb-6">
    <div class="flex flex-col md:flex-row justify-between items-center md:items-start gap-6 md:gap-0">
      <div class="text-center md:text-left">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Gurihlicious Logo" class="h-20 mb-2 mx-auto md:mx-0">
        <p class="text-xl font-medium">"Gurihlicious –<br>Sensasi Gurih dalam<br>Setiap Gigitan!"</p>
      </div>
      <div class="text-center md:text-right pt-30">
        <h3 class="cursor-default">Contact Us</h3>
        <span class="cursor-default">📱 085123456789</span>
      </div>
    </div>
    <div class="mt-6 flex justify-between items-center text-sm border-t pt-4">
      <span class="cursor-default">© 2025 Gurihlicious. All Rights Reserved.</span>
      <div class="space-x-4">
        <a href="#" class="hover:underline">Tentang Kami</a>
        <a href="#" class="hover:underline">@TelkomUniversity</a>
      </div>
    </div>
  </footer>

</body>
</html>

