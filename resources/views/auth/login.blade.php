<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gurihlicious Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Itim', cursive;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-cover bg-no-repeat bg-center bg-fixed" style="background-image: url('{{ asset('images/bg.png') }}');">

  <!-- Navbar -->
  <nav class="bg-[#FEF9E1] py-3 px-6">
    <div class="container mx-auto">
      <img src="{{ asset('images/logo.png') }}" alt="Gurihlicious" width="106" height="106" class="w-[106px] h-[106px] object-contain">
    </div>
  </nav>

  <!-- Login Form -->
  <div class="flex flex-1 items-center justify-center px-4">
    <div class="bg-[#6D2323] p-12 rounded-2xl text-center w-full max-w-md shadow-lg">
      <h2 class="text-[40px] text-[#FEF9E1] mb-6">MASUK</h2>

      <!-- Session Status -->
      @if (session('status'))
        <div class="mb-4 text-sm text-green-500">
          {{ session('status') }}
        </div>
      @endif

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Input -->
        <div>
          <input
            type="email"
            name="email"
            placeholder="Email"
            value="{{ old('email') }}"
            required
            autofocus
            class="w-full bg-[#FEF9E1] text-black px-4 py-3 rounded-[20px] border-none focus:outline-none"
          />
          @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password Input -->
        <div>
          <input
            type="password"
            name="password"
            placeholder="Kata Sandi"
            required
            class="w-full bg-[#FEF9E1] text-black px-4 py-3 rounded-[20px] border-none focus:outline-none"
          />
          @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-6 flex items-center">
          <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
          <label for="remember_me" class="ml-2 block text-[#E5D0AC] text-sm">Ingat saya</label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-4/5 bg-[#FEF9E1] text-black text-[20px] font-sans py-2 rounded-[20px] hover:bg-[#E5D0AC] transition"
        >
          Masuk
        </button>
      </form>

      <!-- Register Link -->
      <p class="text-[#FEF9E1] mt-6 text-[20px]">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-black hover:underline">Daftar Sekarang</a>
      </p>
    </div>
  </div>

</body>
</html>
