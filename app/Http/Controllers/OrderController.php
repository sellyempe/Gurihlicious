<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Tampilkan halaman checkout: isi cart + form input data pemesan
    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('orders.checkout', compact('cart', 'products'));
    }

    // Proses submit form checkout, buat order dan order items
    public function processCheckout(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
    ]);

    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    $products = Product::whereIn('id', array_keys($cart))->get();
    $total = 0;
    foreach ($products as $product) {
        $qty = $cart[$product->id];
        $total += $product->price * $qty;
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'status' => 'pending',
        'total_price' => $total,
    ]);

    foreach ($products as $product) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $cart[$product->id],
            'price' => $product->price,
        ]);
    }

    session()->forget('cart');

    return redirect()->route('payment.show', $order->id)->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
}

    // Tampilkan halaman payment
    public function showPayment($orderId)
    {
        $order = Order::findOrFail($orderId);
    
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    
        // Buat order_id yang unik
        $uniqueOrderId = $order->id . '-' . time();
    
        // Buat token Snap
        $params = [
            'transaction_details' => [
                'order_id' => $uniqueOrderId,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->user->email ?? 'dummy@example.com', // jaga-jaga kalau user ga punya email
            ],
        ];
    
        $snapToken = Snap::getSnapToken($params);
    
        $order->load('items.product'); // relasi orderItems dan product
    
        return view('payment.show', compact('order', 'snapToken'));
    }


    public function history()
{
    $orders = Order::with('items.product')
        ->where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->get();

    return view('orders.history', compact('orders'));
}

public function show(Order $order)
{
    // Pastikan hanya user yang punya order yang bisa lihat
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    // Load relasi items dan product agar bisa diakses di blade
    $order->load('items.product');

    return view('orders.show', compact('order'));
}

public function markPrepared(Order $order)
{
    $order->status = 'Disiapkan';
    $order->save();

    return response()->json(['message' => 'Status updated to prepared']);
}


public function index()
{
    // Mengambil pesanan terbaru dengan relasi user
    $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(20);
    return view('admin.orders.index', compact('orders'));
}

// Update status pesanan
public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->status;  // pastikan statusnya string, bukan variabel tanpa tanda kutip
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Status berhasil diubah.');
}


// Detail pesanan (opsional)
public function showAdmin(Order $order)
{
    $order->load('user', 'items.product'); // contoh relasi tambahan
    return view('admin.orders.show', compact('order'));
}


     public function dashboard()
    {
        $totalOrders = \App\Models\Order::count();
        $totalCustomers = \App\Models\User::where('role', 'user')->count(); // asumsikan role customer
        $totalRevenue = \App\Models\Order::where('status', '!=', 'cancelled')->sum('total_price');

        return view('admin.dashboard', compact('totalOrders', 'totalCustomers', 'totalRevenue'));
    }

    
}
