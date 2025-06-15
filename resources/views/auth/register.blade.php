<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gurihlicious Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Itim', cursive;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-cover bg-no-repeat bg-center bg-fixed items-center" style="background-image: url('{{ asset('images/bg.png') }}');">

    <!-- Navbar -->
    <nav class="bg-[#FEF9E1] py-3 px-6 w-full shadow">
        <div class="container mx-auto">
            <img src="{{ asset('images/logo.png') }}" alt="Gurihlicious" class="w-[106px] h-[106px] object-contain">
        </div>
    </nav>

    <!-- Form Card -->
    <div class="bg-[#6D2323] backdrop-blur-md p-8 rounded-xl shadow-lg w-full max-w-md mt-10 mx-4">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama Pengguna -->
            <div class="mb-4">
                <label for="name" class="block text-[#FEF9E1] font-semibold">Nama Pengguna</label>
                <input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{ old('name') }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" />
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-[#FEF9E1] font-semibold">Email</label>
                <input id="email" name="email" type="email" required autocomplete="username" value="{{ old('email') }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" />
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kata sandi -->
            <div class="mb-4">
                <label for="password" class="block text-[#FEF9E1] font-semibold">Kata Sandi</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" />
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Kata Sandi -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-[#FEF9E1] font-semibold">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" />
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Aksi -->
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-[#FEF9E1] hover:text-gray-900 underline">Sudah daftar?</a>
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                    Daftar
                </button>
            </div>
        </form>
    </div>

</body>
</html>
