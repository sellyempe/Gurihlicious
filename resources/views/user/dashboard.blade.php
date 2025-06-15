<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gurihlicious</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <div style="background-color: #FEF9E1;">
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8 border-b-[10px] border-[#5F1515]" aria-label="Global">


        <div class="flex lg:flex-1">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-20 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo">
          </a>
        </div>
        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
          <a href="{{ route('catalog') }}" class="text-sm font-semibold text-gray-900">Produk</a>
          <a href="#" class="text-sm font-semibold text-gray-900">Tentang Kami</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
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
      </nav>
    </header>



    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
        <div class="text-center">
          <h1 class="text-5xl font-semibold tracking-tight text-[#5F1515] sm:text-7xl">Selamat Datang!</h1>
          <p class="mt-8 text-lg font-medium text-[#5F1515] sm:text-xl">"Kami menghadirkan makanan dengan bahan
            berkualitas, cita rasa autentik, dan proses pembuatan yang higenis. Pesan sekarang dan rasakan
            kelezatannya!"</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ route('catalog') }}"
              class="rounded-md bg-[#5F1515] px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Lihat
              Produk</a>
            <a href="#" class="text-sm font-semibold text-gray-900">Tentang Kami <span aria-hidden="true">→</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuButton && userDropdown) {
      userMenuButton.addEventListener('click', function (event) {
        event.stopPropagation();
        userDropdown.classList.toggle('hidden');
      });

      window.addEventListener('click', function () {
        userDropdown.classList.add('hidden');
      });
    }
  });
</script>

</html>