<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customers; // Menggunakan model Customer
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Method untuk menampilkan halaman checkout dengan detail cart
    public function index()
    {
        // Ambil data customer berdasarkan user yang sedang login
        $customer = Customers::where('user_id', Auth::id())->first();

        // Jika data customer tidak ada, bisa mengarahkan ke halaman lain atau memberikan pesan error

        // Ambil data cart dari database berdasarkan pengguna yang sedang login
        $cart = Cart::where('user_id', Auth::id())->get();

        // Hitung total harga pesanan
        $total = $cart->sum(function ($item) {
            // Pastikan harga dan jumlah ada dan valid
            return $item->price * $item->quantity;
        });

        // Kirim data cart, total harga, dan customer ke view
        return view('PageUser.Shope.checkout.index', compact('cart', 'total', 'customer'));
    }




    // Menyimpan data checkout
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:customers,phone',
            'address1' => 'required|string|max:255',
            'address2' => 'required|string|max:255',
            'address3' => 'required|string|max:500',
            'order_date' => 'required|date',
            'payment_method' => 'required|string',
        ]);

        // Ambil item dari session cart
        $cartItems = session('cart', []);

        // Jika keranjang kosong, kembalikan dengan pesan error
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Simpan data pelanggan
        $customer = Customers::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address1' => $validated['address1'],
            'address2' => $validated['address2'],
            'address3' => $validated['address3'],
            'order_date' => $validated['order_date'],
            'payment_method' => $validated['payment_method'],
            'total_price' => collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']),
        ]);

        // Simpan data item pesanan ke database
        foreach ($cartItems as $item) {
            OrderItem::create([
                'products_id' => $item['product_id'],
                'customers_id' => $customer->id,
                'product_name' => $item['product_name'],
                'total_price' => $item['quantity'] * $item['price'],
                'quantity' => $item['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        // Redirect ke halaman konfirmasi dengan ID pelanggan
        return redirect()->route('checkout.confirmation', ['customer' => $customer->id])
            ->with('success', 'Order placed successfully!');
    }



    // Menampilkan halaman konfirmasi pesanan
    public function orderConfirmation($customerId)
    {
        // Ambil data pelanggan beserta semua item pesanan dan produk terkait
        $customer = Customers::with('orderItems.product.reviews')->findOrFail($customerId);

        // Ambil item pesanan dari customer
        $orderItems = $customer->orderItems;

        // Ambil produk pertama dari item pesanan untuk review (sesuaikan dengan logika Anda)
        $product = $orderItems->first()->product ?? null;

        return view('PageUser.Shope.checkout.confirmation', [
            'customers' => $customer,
            'orderItems' => $orderItems,
            'product' => $product, // Kirim produk ke tampilan
        ]);
    }






}
