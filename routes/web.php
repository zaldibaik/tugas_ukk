<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Models\Product;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsUserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountCategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdermanagementController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductReviewController;


// Home and About pages
Route::get('/', [ProductController::class, 'home'])->name('home.index');
Route::view('/about', 'layoutsGuest.about')->name('about');

Route::get('/search', function (Illuminate\Http\Request $request) {
    $query = $request->input('query');
    $products = Product::where('product_name', 'like', "%{$query}%")->get();

    return view('PageUser.Shope.Index', compact('products', 'query'));
})->name('search');

// Dashboard with auth and verified middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/order/success', fn() => view('order.success'))->name('order.success');

    Route::view('/dashboard', 'PageUser.dashboard')->name('dashboard');
});

// Checkout and order confirmation
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('checkout/confirmation/{customer}', [CheckoutController::class, 'orderConfirmation'])->name('checkout.confirmation');

Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('payments/create/{orderId}', [PaymentController::class, 'create'])->name('payments.create');
Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');

// Product routes for admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class)->except(['store', 'destroy']);
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('discountCategories', DiscountCategoryController::class)->except(['show']);
    Route::resource('discounts', DiscountController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('users', UserController::class);
    Route::resource('wishlists', WishlistController::class);

    Route::get('/managementOrder', [OrdermanagementController::class, 'index'])->name('managementOrder.index');
    Route::get('/managementOrder/create', [OrdermanagementController::class, 'create'])->name('managementOrder.create');
    Route::post('/managementOrder', [OrdermanagementController::class, 'store'])->name('managementOrder.store');
    Route::delete('/managementOrder/{id}', [OrdermanagementController::class, 'destroy'])->name('managementOrder.destroy');
    Route::get('/managementOrder/edit/{id}', [OrdermanagementController::class, 'edit'])->name('managementOrder.edit');
    Route::put('/managementOrder/edit/{id}', [OrdermanagementController::class, 'update'])->name('managementOrder.update');
    Route::get('/managementOrder/{id}', [OrdermanagementController::class, 'show'])->name('managementOrder.show');
});

// Sales and shop routes for authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/shop', [ProductsUserController::class, 'Shope'])->name('sales.shop');
    Route::get('/shop/show/{id}', [ProductsUserController::class, 'show'])->name('show.shop');
});

// Cart routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
});

// Profile routes with auth middleware  
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/wishlist/index', [WishlistController::class, 'index'])->name('wishlists.index');  // Corrected method to show wishlist

    Route::get('/wishlists', [WishlistController::class, 'indexWishlist'])->name('wishlists.indexWishlist');  // Corrected to show user-specific wishlists

    Route::get('/wishlists/add/{id}', [WishlistController::class, 'create'])->name('wishlists.create');  // Corrected to create a new wishlist
    Route::post('/wishlists', [WishlistController::class, 'store'])->name('wishlists.store');  // Corrected to store wishlist
    Route::get('/wishlists/{wishlist}', [WishlistController::class, 'show'])->name('wishlists.show');  // Corrected to show specific wishlist
    Route::get('/wishlists/{wishlist}/edit', [WishlistController::class, 'edit'])->name('wishlists.edit');  // Corrected to edit wishlist
    Route::put('/wishlists/{wishlist}', [WishlistController::class, 'update'])->name('wishlists.update');  // Corrected to update wishlist
    Route::delete('/wishlist/remove/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');  // Corrected to remove wishlist item
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');  // Corrected to add product to wishlist
});


Route::middleware(['auth'])->group(function () {
    Route::get('products/{productId}/reviews', [ProductReviewController::class, 'index'])->name('reviews.index');
    Route::get('products/{productId}/reviews/create', [ProductReviewController::class, 'create'])->name('reviews.create');
    Route::post('products/{productId}/reviews', [ProductReviewController::class, 'store'])->name('reviews.store');
    Route::delete('reviews/{id}', [ProductReviewController::class, 'destroy'])->name('reviews.destroy');

  // Menampilkan form create
Route::get('/Customers', [CustomersController::class, 'create'])->name('customers.create');

// Menyimpan data ke database
Route::post('/Customers', [CustomersController::class, 'store'])->name('customers.store');



});


// Authentication routes
require __DIR__ . '/auth.php';
