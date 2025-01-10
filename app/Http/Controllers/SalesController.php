<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        // Jika Anda ingin menampilkan daftar penjualan, simpan logika di sini
        return view('PageUser.sales.index'); // Mengembalikan view untuk daftar penjualan
    }

    public function topup()
    {
        // Mengembalikan view untuk halaman Top-up
        return view('PageUser.topup.index'); // Pastikan path view ini benar
    }
}
