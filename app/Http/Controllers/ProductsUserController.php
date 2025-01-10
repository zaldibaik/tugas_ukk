<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ProductsUserController extends Controller
{
    // Menampilkan halaman Shop
    public function shope()
    {
        // Mengambil produk beserta relasi discounts
        $products = Products::with('category', 'discounts')->get();


        // Pastikan wishlists adalah koleksi kosong jika tidak ada
        $wishlists = auth()->check() ? auth()->user()->wishlists : collect();

        // Return view dengan data produk dan wishlists
        return view('PageUser.Shope.index', compact('products', 'wishlists'));
    }
    
    public function index()
    {
        // Mengambil produk beserta relasi discounts
        $products = Products::with('discounts')->get();

        // Pastikan wishlists adalah koleksi kosong jika tidak ada
        $wishlists = auth()->check() ? auth()->user()->wishlists : collect();

        // Return view dengan data produk dan wishlists
        return view('PageUser.Shope.wishliss', compact('products', 'wishlists'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stok_quantity' => 'required|numeric|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'image1_url' => 'nullable|image|max:2048',
            'image2_url' => 'nullable|image|max:2048',
            'image3_url' => 'nullable|image|max:2048',
            'image4_url' => 'nullable|image|max:2048',
            'image5_url' => 'nullable|image|max:2048',
        ]);

        // Handle upload gambar
        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            $key = "image{$i}_url";
            $images[$key] = $this->handleImageUpload($request, $key);
        }

        // Simpan produk ke database
        Products::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stok_quantity' => $request->stok_quantity,
            'product_category_id' => $request->product_category_id,
            'image1_url' => $images['image1_url'],
            'image2_url' => $images['image2_url'],
            'image3_url' => $images['image3_url'],
            'image4_url' => $images['image4_url'],
            'image5_url' => $images['image5_url'],
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Detail produk
    public function show($id)
{
    // Temukan produk berdasarkan ID
    $product = Products::findOrFail($id);

    // Ambil review terkait dengan produk beserta nama pelanggan
    $reviews = $product->reviews()->with('customers')->get();

    // Return view dengan data produk dan reviews
    return view('PageUser.Shope.show', compact('product', 'reviews'));
}


    // Fungsi untuk mengunggah gambar
    private function handleImageUpload(Request $request, $key)
    {
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            return $file->store('images/products', 'public');
        }
        return null;
    }
    public function remove($id)
    {
        // Pastikan pengguna login
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menghapus wishlist.');
        }

        // Temukan wishlist berdasarkan ID dan user_id
        $wishlist = $user->wishlists()->where('id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Item wishlist berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Item wishlist tidak ditemukan.');
    }
}
