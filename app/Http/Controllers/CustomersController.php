<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    /**
     * Tampilkan form untuk membuat customer baru.
     */
    public function create()
    {
        return view('Customers.create');
    }

    /**
     * Simpan data customer ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:customers,phone',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'required|string|max:255',
        ]);

        // Simpan data customer
        Customers::create([
            'user_id' => Auth::id(), // Pastikan tabel memiliki kolom 'user_id'
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address1' => $validated['address1'],
            'address2' => $validated['address2'],
            'address3' => $validated['address3'],
        ]);

        // Redirect ke halaman daftar customer dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Customer added successfully.');
    }
}
