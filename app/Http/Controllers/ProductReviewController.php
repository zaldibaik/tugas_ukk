<?php
namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * Menampilkan semua review untuk sebuah produk.
     *
     * @param  int  $productId
     * @return \Illuminate\View\View
     */
    public function index($productId)
    {
        $product = Product::findOrFail($productId);

        // Pastikan nama relasi sesuai dengan model ProductReview
        $reviews = ProductReview::where('product_id', $productId)
            ->with('customers') // Menggunakan nama relasi yang benar
            ->latest()
            ->get();

        return view('reviews.index', compact('product', 'reviews'));
    }

    /**
     * Menampilkan form untuk menambahkan review baru.
     *
     * @param  int  $productId
     * @return \Illuminate\View\View
     */
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('reviews.create', compact('product'));
    }

    /**
     * Menyimpan review baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $product = Product::findOrFail($productId);

        ProductReview::create([
            'customer_id' => auth()->id(), // Gunakan relasi customer yang benar
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment, 
        ]);

        return redirect()
            ->route('show.shop', $productId)
            ->with('success', 'Review berhasil ditambahkan!');
    }

    /**
     * Menghapus review yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $review = ProductReview::findOrFail($id);

        // Cek apakah review dimiliki oleh pengguna saat ini
        if ($review->customer_id !== auth()->id()) {
            return redirect()
                ->back()
                ->with('error', 'Anda tidak memiliki izin untuk menghapus review ini.');
        }

        $review->delete();

        return redirect()
            ->back()
            ->with('success', 'Review berhasil dihapus.');
    }
}

