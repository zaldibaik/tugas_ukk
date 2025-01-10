<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->route('sales.shop')->with('error', 'Product not found');
        }

        // Get the current cart from the session, or create an empty array if not exists
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // Update quantity if the product is already in the cart
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            // Add new product to the cart
            $cart[$productId] = [
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => $request->quantity,
            ];
        }

        // Save the updated cart to the session
        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Product added to cart');
    }

    public function show()
{
    // Ambil cart dari session
    $cart = session()->get('cart', []);

    // Inisialisasi total harga
    $total = 0;

    // Hitung total harga
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Pass cart dan total ke view
    return view('PageUser.Shope.cart.show', compact('cart', 'total'));
}


    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product removed from cart');
    }
    public function checkout(Request $request)
{
    // Process the checkout and create the order, save it to the database
    $order = new Cart();
    $order->user_id = auth()->id(); // Assuming you are using authentication
    $order->total = $request->total; // Assuming you're passing the total amount from the checkout page
    $order->save();

    // Clear the cart from the session
    session()->forget('cart');

    // Redirect to a confirmation page or another route
    return redirect()->route('order.confirmation')->with('success', 'Your order has been placed!');
}


}

