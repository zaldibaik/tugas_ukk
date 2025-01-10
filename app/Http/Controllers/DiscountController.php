<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Products;
use App\Models\DiscountCategory;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('managementDiscountProduct.index', compact('discounts'));
    }

    public function create()
    {
        // Ambil semua kategori diskon
        $discountCategories = DiscountCategory::all();
        $products = Products::all();

        // Kirimkan ke view
        return view('managementDiscountProduct.create', compact('discountCategories','products'));
    }
    

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'category_discount_id' => 'required',
            'products_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'percentage' => 'required|integer|min:1|max:100',
        ]);
        

        // Buat discount baru
        Discount::create($request->all());
        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    public function show($id)
    {
        $discount = Discount::findOrFail($id);
        return view('managementDiscountProduct.show', compact('discount'));
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $categories = DiscountCategory::all(); // Mengambil semua kategori diskon
        return view('managementDiscountProduct.edit', compact('discount', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'category_discount_id' => 'required|exists:discount_categories,id',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'percentage' => 'required|integer|between:1,100',
        ]);

        // Update discount yang sudah ada
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
        return redirect()->route('discounts.index')->with('update_success', 'Discount updated successfully.');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->route('discounts.index')->with('delete_success', 'Discount deleted successfully.');
    }
}
