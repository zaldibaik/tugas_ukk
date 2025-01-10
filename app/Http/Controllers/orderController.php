<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class orderController extends Controller
{
    public function checkout(Request $request)
    {
        // Validasi user harus login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan checkout.');
        }

        // Ambil item keranjang berdasarkan user yang sedang login
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        // Cek apakah keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Keranjang Anda kosong.');
        }

        // Mulai transaksi database untuk menjaga konsistensi data
        DB::beginTransaction();

        try {
            // Buat pesanan baru
            $order = Customers::create([
                'customer_id' => auth()->id(),
                'order_date' => now(),
                'total_amount' => $cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                }),
                'status' => 'Pending',
            ]);

            // Buat item pesanan dari keranjang
            foreach ($cartItems as $item) {
                $order->orderItems()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Kosongkan keranjang setelah checkout
            Cart::where('user_id', auth()->id())->delete();

            // Commit transaksi jika semua berhasil
            DB::commit();

            // Redirect ke halaman sukses dengan pesan
            return redirect()->route('order.success')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Log error untuk debugging
            \Log::error("Error during checkout: " . $e->getMessage());

            // Redirect ke halaman keranjang dengan pesan error
            return redirect()->route('cart.show')->with('error', 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.');
        }
    }
}
