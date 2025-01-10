<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customers;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('Customers')->get();
        return view('payments.index', compact('payments'));
    }
    // Tampilkan form untuk membuat pembayaran baru
    public function create($orderId)
{
    $order = Customers::findOrFail($orderId);

    if ($order->status !== 'unpaid') {
        return redirect()->route('sales.shop')->with('error', 'Order has already been paid.');
    }

    return view('PageUser.Shope.checkout.pay', compact('order'));
}



    // Simpan data pembayaran baru
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        // Simpan data pembayaran
        $payments = Payment::create([
            'order_id' => $request->order_id,
            'payment_date' => now(),
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
        ]);

        // Tandai pesanan sebagai telah dibayar
        $order = Customers::findOrFail($request->order_id);
        $order->status = 'paid';
        $order->save();

        return redirect()->route('sales.shop')->with('success', 'Payment successfully processed!');
    }
}
