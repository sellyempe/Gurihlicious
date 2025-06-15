<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Tampilkan halaman isi cart
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        return view('cart.index', compact('cart', 'products'));
    }

    // Tambah produk ke cart
    public function add(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        $currentQty = $cart[$product->id] ?? 0;
        $newQty = $currentQty + 1;

        if ($newQty > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$product->id] = $newQty;
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Update quantity produk di cart
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $newQty = $request->quantity;

        if ($newQty > $product->stock) {
            return redirect()->route('cart.index')->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] = $newQty;
            $request->session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diupdate.');
        }

        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    // Hapus produk dari cart
    public function remove(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $request->session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
    }
}
