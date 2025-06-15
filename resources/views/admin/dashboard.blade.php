<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEF9E1] font-sans">
<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#E3C7A2] text-[#5A0000] flex flex-col">
        <div class="p-4">
            <img src="{{ asset('images/logo.png') }}" alt="Gurihlicious" width="106" height="106" class="w-[106px] h-[106px] object-contain">
            <nav class="space-y-4">
                <a href="#" class="flex items-center gap-2 p-3 bg-[#FFF7DD] rounded-md font-semibold">Dashboard</a>
                <a href="{{ route('orders.index') }}" class="flex items-center gap-2 p-3 bg-[#FFF7DD] rounded-md font-semibold text-[#5A0000]">Order</a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-2 p-3 bg-[#FFF7DD] rounded-md font-semibold text-[#5A0000]">Stok Produk</a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Header -->
        <div class="flex justify-between items-center bg-[#E3C7A2] p-4 rounded-md relative">
            <h1 class="text-xl font-semibold text-[#5A0000]">Dashboard</h1>
            <div class="relative inline-block text-left">
                <button id="dropdownToggle" class="text-[#5A0000] font-medium focus:outline-none">
                    Haloo, Admin!
                </button>

                <!-- Dropdown Logout -->
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-32 bg-white border border-gray-300 rounded shadow-lg hidden z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left bg-[#5F1515] text-white px-4 py-2 rounded hover:bg-[#6D2323]">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div class="bg-[#E3C7A2] p-4 rounded-lg flex items-center gap-4">
        <div class="bg-[#5A0000] text-white p-2 rounded-md">✔️</div>
        <div>
            <div class="text-[#5A0000] text-2xl font-bold">{{ $totalOrders }}</div>
            <div class="text-[#5A0000] text-sm">Pesanan</div>
        </div>
    </div>
    <div class="bg-[#E3C7A2] p-4 rounded-lg flex items-center gap-4">
        <div class="bg-[#5A0000] text-white p-2 rounded-md">✔️</div>
        <div>
            <div class="text-[#5A0000] text-2xl font-bold">{{ $totalCustomers }}</div>
            <div class="text-[#5A0000] text-sm">Pembeli</div>
        </div>
    </div>
    <div class="bg-[#E3C7A2] p-4 rounded-lg flex items-center gap-4">
        <div class="bg-[#5A0000] text-white p-2 rounded-md">✔️</div>
        <div>
            <div class="text-[#5A0000] text-2xl font-bold">Rp.{{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="text-[#5A0000] text-sm">Pendapatan</div>
        </div>
    </div>
</div>


<!-- Toggle Script -->
<script>
    const toggle = document.getElementById('dropdownToggle');
    const menu = document.getElementById('dropdownMenu');

    toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        if (!toggle.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>

</body>
</html>
