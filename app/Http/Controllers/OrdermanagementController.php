<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class OrdermanagementController extends Controller
{
    // Menampilkan semua orders
    public function index()
{
    $orders = Customers::with(['orderItems'])->get(); 
    return view('PageUser.orderManagement.index', compact('orders'));
}

    // Menampilkan form untuk membuat order baru
    public function create()
    {
        return view('PageUser.orderManagement.create');
    }

    // Menyimpan order baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9\-\+\s]+$/', // Validasi format nomor telepon
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'nullable|string|max:255',
            'payment_method' => 'required|string|in:cash,credit_card',
        ]);

        try {
            // Simpan order baru
            $order = new Customers();
            $order->name = $validated['name'];
            $order->phone = $validated['phone'];
            $order->address1 = $validated['address1'];
            $order->address2 = $validated['address2'];
            $order->address3 = $validated['address3'];
            $order->payment_method = $validated['payment_method'];
            $order->save();

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('managementOrder.index')->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            return redirect()->back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }


    // Menampilkan detail order
    public function show($id)
    {
        $order = Customers::findOrFail($id); // Cari order berdasarkan ID
        return view('PageUser.orderManagement.show', compact('order'));
    }

    // Menampilkan form untuk mengedit order
    public function edit($id)
    {
        $order = Customers::findOrFail($id); // Cari order berdasarkan ID
        return view('PageUser.orderManagement.edit', compact('order'));
    }

    // Memperbarui data order
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'nullable|string|max:255',
            'payment_method' => 'required|string|in:cash,credit_card',
        ]);

        // Cari order berdasarkan ID
        $order = Customers::findOrFail($id);

        // Perbarui data order
        $order->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'payment_method' => $request->payment_method,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('managementOrder.index')->with('success', 'Order updated successfully.');
    }

    // Menghapus order
    public function destroy($id)
    {
        $order = Customers::findOrFail($id);

        // Hapus order
        $order->delete();

        return redirect()->route('managementOrder.index')->with('success', 'Order deleted successfully.');
    }
}
