<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Menampilkan daftar wishlist berdasarkan user yang sedang login

    // Menampilkan wishlist spesifik (ini digunakan di route 'wishlists.wishlist')
    public function index()
    {
        $wishlists = Wishlist::with('product')->get();  // Mengambil produk yang ada di wishlist
        return view('wishlists.index', compact('wishlists'));
    }
    public function indexWishlist()
    {
        $wishlists = Wishlist::with('product')->get();  // Mengambil produk yang ada di wishlist
        return view('PageUser.Shope.wishlists', compact('wishlists'));
    }

    // Menambahkan produk ke wishlist
    public function add($id)
{
    $user = auth()->user();
    
    if ($user) {
        // Cari produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product not found!');
        }

        // Periksa apakah produk sudah ada di wishlist pengguna
        $existingWishlist = $user->wishlists()->where('product_id', $product->id)->first();

        if (!$existingWishlist) {
            // Menambahkan produk ke wishlist
            $user->wishlists()->create([ 
                'product_id' => $product->id,
            ]);

            return back()->with('success', 'Product added to your wishlist!');
        }

        return back()->with('error', 'Product is already in your wishlist!');
    }

    return redirect()->route('login')->with('error', 'You must be logged in to add items to your wishlist.');
}


    // Menampilkan form untuk membuat wishlist
    public function create(Product $product)
    {
        return view('wishlists.create', compact('product'));
    }

    // Menyimpan wishlist baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        Wishlist::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('wishlists.index')->with('success', 'Wishlist successfully added!');
    }

    // Menampilkan detail wishlist
    public function show(Wishlist $wishlist)
    {
        return view('wishlists.show', compact('wishlist'));
    }

    // Menampilkan form untuk mengedit wishlist
    public function edit(Wishlist $wishlist)
    {
        $products = Product::all(); // Ambil semua produk
        return view('wishlists.edit', compact('wishlist', 'products'));
    }

    // Mengupdate wishlist
    public function update(Request $request, Wishlist $wishlist)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist->update([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('wishlists.index')->with('success', 'Wishlist updated successfully!');
    }

    // Menghapus wishlist
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->route('wishlists.indexWishlist')->with('success', 'Wishlist deleted successfully!');
    }

    // Menghapus item dari wishlis
}
