<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $categories = ProductCategory::all();
        return view('PageUser.managementProduct.categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori
    public function create()
    {
        return view('PageUser.managementProduct.categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:product_categories,category_name',
        ]);

        ProductCategory::create([
            'category_name' => $request->category_name,
        ]);
        

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('PageUser.managementProduct.categories.Update', compact('category'));
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:product_categories,category_name,' . $id,
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    
}
