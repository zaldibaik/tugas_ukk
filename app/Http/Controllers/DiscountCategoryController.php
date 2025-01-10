<?php

// app/Http/Controllers/DiscountCategoryController.php
namespace App\Http\Controllers;

use App\Models\DiscountCategory;
use Illuminate\Http\Request;

class DiscountCategoryController extends Controller
{
    public function index()
    {
        $discountCategories = DiscountCategory::all();
        return view('managementDiscountProduct.discountCategories.index', compact('discountCategories'));
    }

    public function create()
    {
        return view('managementDiscountProduct.discountCategories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['category_name' => 'required|string|max:255']);
        DiscountCategory::create(['category_name' => $request->category_name]);
        return redirect()->route('discountCategories.index');
    }

    public function edit($id)
    {
        $category = DiscountCategory::findOrFail($id);
        return view('managementDiscountProduct.discountCategories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['category_name' => 'required|string|max:255']);
        $category = DiscountCategory::findOrFail($id);
        $category->update(['category_name' => $request->category_name]);
        return redirect()->route('categorydiscounts.index');
    }

    public function destroy($id)
{
    $category = DiscountCategory::findOrFail($id);

    if ($category->delete()) {
        return redirect()->route('discountCategories.index')->with('success', 'Kategori diskon berhasil dihapus.');
    } else {
        return redirect()->route('discountCategories.index')->with('error', 'Gagal menghapus kategori diskon.');
    }
}

}

