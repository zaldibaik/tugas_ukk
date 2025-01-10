<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Helper method for handling image upload
    private function handleImageUpload(Request $request, $imageField, $existingImage = null)
    {
        // Check if the file exists
        if ($request->hasFile($imageField)) {
            return $request->file($imageField)->store('images', 'public');
        }
        
        // Return existing image or default one if none exists
        return $existingImage ?? 'default_image_url.jpg';
    }

    // Display the list of products
    public function index()
    {
        $products = Products::all();
        return view('PageUser.managementProduct.index', compact('products'));
    }
    public function home()
    {
        $products = Products::all();
        return view('layoutsGuest.home', compact('products'));
    }

    // Show form for creating a new product
    public function create()
    {
        $categories = ProductCategory::all();
        return view('PageUser.managementProduct.create', compact('categories'));
    }

    // Show form for editing a product
    public function edit(Products $product)
    {
        $categories = ProductCategory::all();
        return view('PageUser.managementProduct.Update', compact('product', 'categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stok_quantity' => 'required|numeric',
            'product_category_id' => 'required|exists:product_categories,id',
            'image1_url' => 'nullable|image|max:2048',
            'image2_url' => 'nullable|image|max:2048',
            'image3_url' => 'nullable|image|max:2048',
            'image4_url' => 'nullable|image|max:2048',
            'image5_url' => 'nullable|image|max:2048',
        ]);

        // Handle image uploads
        $image1 = $this->handleImageUpload($request, 'image1_url');
        $image2 = $this->handleImageUpload($request, 'image2_url');
        $image3 = $this->handleImageUpload($request, 'image3_url');
        $image4 = $this->handleImageUpload($request, 'image4_url');
        $image5 = $this->handleImageUpload($request, 'image5_url');

        // Store the product
        Products::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stok_quantity' => $request->stok_quantity,
            'product_category_id' => $request->product_category_id,
            'image1_url' => $image1,
            'image2_url' => $image2,
            'image3_url' => $image3,
            'image4_url' => $image4,
            'image5_url' => $image5,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    // Update an existing product
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stok_quantity' => 'required|numeric',
            'product_category_id' => 'required|exists:product_categories,id',
            'image1_url' => 'nullable|image|max:2048',
            'image2_url' => 'nullable|image|max:2048',
            'image3_url' => 'nullable|image|max:2048',
            'image4_url' => 'nullable|image|max:2048',
            'image5_url' => 'nullable|image|max:2048',
        ]);

        // Handle image uploads, use existing images if not updated
        $image1 = $this->handleImageUpload($request, 'image1_url', $product->image1_url);
        $image2 = $this->handleImageUpload($request, 'image2_url', $product->image2_url);
        $image3 = $this->handleImageUpload($request, 'image3_url', $product->image3_url);
        $image4 = $this->handleImageUpload($request, 'image4_url', $product->image4_url);
        $image5 = $this->handleImageUpload($request, 'image5_url', $product->image5_url);

        // Update the product
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stok_quantity' => $request->stok_quantity,
            'product_category_id' => $request->product_category_id,
            'image1_url' => $image1,
            'image2_url' => $image2,
            'image3_url' => $image3,
            'image4_url' => $image4,
            'image5_url' => $image5,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Delete a product
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    // Confirm checkout logic
    public function confirmCheckout(Request $request)
    {
        $product = Products::find($request->product_id);
        $quantity = $request->quantity;

        if ($product->stok_quantity < $quantity) {
            return back()->withErrors(['quantity' => 'Quantity exceeds available stock.']);
        }

        // Update stock
        $product->stok_quantity -= $quantity;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Purchase successful');
    }


    // Order confirmation page
    public function orderConfirmation(Order $order)
    {
        return view('PageUser.Shope.checkout.comfirmasi', ['order' => $order]);
    }
    
}
