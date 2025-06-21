<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VendorLoginController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Vendor3Controller;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Home route
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Vendor Selection and Authentication Routes
Route::get('/vendor/select', [VendorLoginController::class, 'selectVendor'])->name('vendor.select');

// UTM Mart vendor routes
Route::get('/vendor/login/utm-mart', [VendorLoginController::class, 'showUtmMartLogin'])->name('vendor.login.utm_mart.form');
Route::post('/vendor/login/utm-mart', [VendorLoginController::class, 'loginUtmMart'])->name('vendor.login.utm_mart');

// Setepak Printing vendor routes
Route::get('/vendor/login/setepak', [VendorLoginController::class, 'showSetepakLogin'])->name('vendor.login.setepak.form');
Route::post('/vendor/login/setepak', [VendorLoginController::class, 'loginSetepak'])->name('vendor.login.setepak');

// Richiamo Caffe vendor routes
Route::get('/vendor/login/richiamo', [VendorLoginController::class, 'showRichiamoLogin'])->name('vendor.login.richiamo.form');
Route::post('/vendor/login/richiamo', [VendorLoginController::class, 'loginRichiamo'])->name('vendor.login.richiamo');

// Vendor logout route (not protected by middleware)
Route::post('/vendor/logout', [VendorLoginController::class, 'logout'])->name('vendor.logout');

// Protected vendor dashboard routes - FIXED MIDDLEWARE NAME
Route::middleware(['vendor'])->group(function () {
    // UTM Mart Dashboard
    Route::get('/vendor/dashboard/utm-mart', [VendorController::class, 'utmMartDashboard'])->name('vendor.dashboard.utm_mart');
    Route::post('/vendor/dashboard/utm-mart/order/{order}/status', [VendorController::class, 'updateOrderStatus'])->name('vendor.dashboard.utm_mart.order.status');
    Route::get('/vendor/dashboard/utm-mart/analytics', [VendorController::class, 'utmMartAnalytics'])->name('vendor.dashboard.utm_mart.analytics');

    // Setepak Dashboard
    Route::get('/vendor/dashboard/setepak', [VendorController::class, 'setepakDashboard'])->name('vendor.dashboard.setepak');
    Route::post('/vendor/dashboard/setepak/order/{order}/status', [VendorController::class, 'updateSetepakOrderStatus'])->name('vendor.dashboard.setepak.order.status');
    Route::get('/vendor/dashboard/setepak/analytics', [VendorController::class, 'setepakAnalytics'])->name('vendor.dashboard.setepak.analytics');

    // Richiamo Caffe Dashboard
    Route::get('/vendor/dashboard/richiamo', [VendorController::class, 'richiamoDashboard'])->name('vendor2.dashboard.caffe');
    Route::post('/vendor/dashboard/richiamo/order/{order}/status', [VendorController::class, 'updateRichiamoOrderStatus'])->name('vendor2.dashboard.caffe.order.status');
    Route::get('/vendor/dashboard/richiamo/analytics', [VendorController::class, 'richiamoAnalytics'])->name('vendor2.dashboard.caffe.analytics');

    // Vendor password management
    Route::post('/vendor/password/send-otp', [VendorController::class, 'sendPasswordOtp'])->name('vendor.password.sendOtp');
    Route::post('/vendor/password/change', [VendorController::class, 'changePassword'])->name('vendor.password.change');

    // Vendor complaints management
    Route::post('/vendor/complaints/{complaint}/status', [VendorController::class, 'updateComplaintStatus'])->name('vendor.complaints.updateStatus');

    // Vendor products management - ADDED MISSING ROUTES
    Route::get('/vendor/products', [VendorController::class, 'products'])->name('vendor.products');
    Route::get('/vendor/products/create', [VendorController::class, 'createProduct'])->name('vendor.products.create');
    Route::post('/vendor/products', [VendorController::class, 'storeProduct'])->name('vendor.products.store');
    Route::get('/vendor/products/{product}/edit', [VendorController::class, 'editProduct'])->name('vendor.products.edit');
    Route::put('/vendor/products/{product}', [VendorController::class, 'updateProduct'])->name('vendor.products.update');
    Route::delete('/vendor/products/{product}', [VendorController::class, 'deleteProduct'])->name('vendor.products.delete');

    Route::get('/vendor2/products', [VendorController::class, 'vendor2Products'])->name('vendor2.products');
    Route::get('/vendor2/products/create', [VendorController::class, 'createVendor2Product'])->name('vendor2.products.create');
    Route::post('/vendor2/products', [VendorController::class, 'storeVendor2Product'])->name('vendor2.products.store');
    Route::get('/vendor2/products/{product}/edit', [VendorController::class, 'editVendor2Product'])->name('vendor2.products.edit');
    Route::put('/vendor2/products/{product}', [VendorController::class, 'updateVendor2Product'])->name('vendor2.products.update');
    Route::delete('/vendor2/products/{product}', [VendorController::class, 'deleteVendor2Product'])->name('vendor2.products.delete');

    Route::get('/vendor3/products', [VendorController::class, 'vendor3Products'])->name('vendor3.products');
    Route::get('/vendor3/products/create', [VendorController::class, 'createVendor3Product'])->name('vendor3.products.create');
    Route::post('/vendor3/products', [VendorController::class, 'storeVendor3Product'])->name('vendor3.products.store');
    Route::get('/vendor3/products/{product}/edit', [VendorController::class, 'editVendor3Product'])->name('vendor3.products.edit');
    Route::put('/vendor3/products/{product}', [VendorController::class, 'updateVendor3Product'])->name('vendor3.products.update');
    Route::delete('/vendor3/products/{product}', [VendorController::class, 'deleteVendor3Product'])->name('vendor3.products.delete');
});

// Public Vendor Pages (not requiring login)
Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/vendor2', function () {
    return view('vendor2.index');
})->name('vendor2.index');
Route::get('/vendor3', [Vendor3Controller::class, 'index'])->name('vendor3.index');

// Cart and Wishlist routes (authentication required)
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
    Route::get('/check-out', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/clear-other-vendors', [CartController::class, 'clearOtherVendors'])->name('cart.clearOtherVendors');

    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');
    Route::get('/wishlist', [WishlistController::class, 'view'])->name('wishlist.view');
    Route::post('/wishlist/remove', function (\Illuminate\Http\Request $request) {
        $wishlist = session('wishlist', []);
        $productId = $request->product_id;

        // Handle both new and old format wishlist items
        if (isset($wishlist[$productId])) {
            // Old format
            unset($wishlist[$productId]);
        } else {
            // New format - look for vendor_id-product_id pattern
            foreach ($wishlist as $key => $item) {
                // Match either the product_id field or extract from composite key
                if ((isset($item['product_id']) && $item['product_id'] == $productId) ||
                    (is_string($key) && strpos($key, '-') !== false && explode('-', $key)[1] == $productId)) {
                    unset($wishlist[$key]);
                    break;
                }
            }
        }

        session(['wishlist' => $wishlist]);
        return back()->with('success', 'Item removed from wishlist.');
    })->name('wishlist.remove');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Vendor-specific cart and checkout routes
Route::get('/vendor2/cart', [CartController::class, 'viewCart'])->name('vendor2.cart.view');
Route::get('/vendor2/wishlist', function () {
    $wishlist = session()->get('wishlist', []);
    $originalWishlistCount = count($wishlist);

    // Filter wishlist to only show Richiamo Caffe items (vendor_id = 2)
    $richiamoWishlist = [];
    foreach ($wishlist as $id => $item) {
        if (isset($item['vendor_id']) && $item['vendor_id'] == 2) {
            $richiamoWishlist[$id] = $item;
        }
    }

    // If there are items from other vendors, update the wishlist session
    if (count($richiamoWishlist) < $originalWishlistCount) {
        session()->put('wishlist', $richiamoWishlist);

        // Flash a message to inform the user
        session()->flash('info', 'Only Richiamo Caffe products are shown in your wishlist. Products from other vendors have been removed.');
    }

    return view('vendor2.Wishlist', ['wishlist' => $richiamoWishlist]);
})->name('vendor2.wishlist.view');

Route::get('/vendor3/cart', [Vendor3Controller::class, 'cartView'])->name('vendor3.cart.view');
Route::get('/vendor3/wishlist', [Vendor3Controller::class, 'wishlistView'])->name('vendor3.wishlist.view');

// Checkout routes
Route::get('/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');

Route::get('/vendor2/checkout/confirmation', function () {
    $cart = session()->get('cart', []);
    $originalCartCount = count($cart);

    // Filter cart to only show Richiamo Caffe items (vendor_id = 2)
    $richiamoCart = [];
    foreach ($cart as $id => $item) {
        if (isset($item['vendor_id']) && $item['vendor_id'] == 2) {
            $richiamoCart[$id] = $item;
        }
    }

    // If there are items from other vendors, remove them from the cart
    if (count($richiamoCart) < $originalCartCount) {
        session()->put('cart', $richiamoCart);

        // Flash a message to inform the user
        session()->flash('info', 'Only Richiamo Caffe products are shown in your cart. Products from other vendors have been removed.');
    }

    return view('vendor2.checkout-confirmation', ['cart' => $richiamoCart]);
})->name('vendor2.checkout.confirmation');
Route::post('/vendor2/checkout/place-order', [CheckoutController::class, 'placeOrderVendor2'])->name('vendor2.checkout.placeOrder');

Route::get('/vendor3/checkout/confirmation', [Vendor3Controller::class, 'checkoutConfirmation'])->name('vendor3.checkout.confirmation');
Route::post('/vendor3/checkout/place-order', [Vendor3Controller::class, 'placeOrder'])->name('vendor3.checkout.placeOrder');
Route::get('/vendor3/cart-debug', [Vendor3Controller::class, 'cartDebug'])->name('vendor3.cart.debug');

// Complaint routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/complaints', [App\Http\Controllers\ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints', [App\Http\Controllers\ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/my', [App\Http\Controllers\ComplaintController::class, 'myComplaints'])->name('complaints.my');
});

// Admin Authentication Routes
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// Admin Protected Routes
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Complaints Management
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
    Route::put('/complaints/{complaint}', [AdminController::class, 'updateComplaint'])->name('admin.complaints.update');

    // Product Management
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Vendor Management
    Route::get('/vendors', [AdminController::class, 'vendors'])->name('admin.vendors');
    Route::post('/vendors/send-otp', [AdminController::class, 'sendVendorPasswordResetOtp'])->name('admin.vendors.sendOtp');
    Route::post('/vendors/reset-password', [AdminController::class, 'resetVendorPassword'])->name('admin.vendors.resetPassword');

    // Analytics
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

    // Admin Management - SUPER ADMIN ONLY
    Route::middleware(['admin:super_admin'])->group(function () {
        Route::get('/admins', [AdminController::class, 'admins'])->name('admin.admins');
        Route::get('/admins/create', [AdminController::class, 'createAdmin'])->name('admin.admins.create');
        Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admin.admins.store');
        Route::get('/admins/{admin}/edit', [AdminController::class, 'editAdmin'])->name('admin.admins.edit');
        Route::put('/admins/{admin}', [AdminController::class, 'updateAdmin'])->name('admin.admins.update');
        Route::delete('/admins/{admin}', [AdminController::class, 'deleteAdmin'])->name('admin.admins.delete');
    });
});

// CSRF token refresh route
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
});

// Chatbot API route
Route::post('/chatbot/message', [App\Http\Controllers\ChatbotController::class, 'chat'])
    ->middleware('auth')
    ->name('chatbot.message');

Route::get('/chatbot/suggestions', [App\Http\Controllers\ChatbotController::class, 'getSuggestions'])
    ->middleware('auth')
    ->name('chatbot.suggestions');

// Static pages
Route::view('/about-us', 'About-us');
Route::view('/contact', 'Contact');
Route::view('/terms-con', 'Terms-con');
Route::view('/privacy-pol', 'Privacy-pol');

// Debugging routes
Route::get('/vendor2/cart-debug', function() {
    $cart = session()->get('cart', []);
    $keys = array_keys($cart);

    return response()->json([
        'all_cart_items' => $cart,
        'cart_keys' => $keys,
        'cart_count' => count($cart),
        'session_id' => session()->getId()
    ]);
})->name('vendor2.cart.debug');

Route::get('/wishlist-debug', function() {
    $wishlist = session()->get('wishlist', []);
    $keys = array_keys($wishlist);

    return response()->json([
        'all_wishlist_items' => $wishlist,
        'wishlist_keys' => $keys,
        'wishlist_count' => count($wishlist),
        'session_id' => session()->getId()
    ]);
})->name('wishlist.debug');

// Temporary routes for maintenance (REMOVE AFTER USE)
Route::get('/run-seeders/{secret_key}', function($secret_key) {
    if ($secret_key !== 'utm_secret_2025') {
        return 'Unauthorized';
    }

    try {
        // Run specific seeders in the correct order
        Artisan::call('db:seed', ['--class' => 'VendorLogInSeeder']);
        Artisan::call('db:seed', ['--class' => 'VendorSeeder']);
        Artisan::call('db:seed', ['--class' => 'ProductSeeder']);
        Artisan::call('db:seed', ['--class' => 'UTMMartProductSeeder']);

        return 'Seeders executed successfully! Products should now appear.';
    } catch (\Exception $e) {
        return 'Error running seeders: ' . $e->getMessage();
    }
})->name('run.seeders');

// Debug route
Route::get('/debug-app/{secret_key}', function($secret_key) {
    if ($secret_key !== 'utm_secret_2025') {
        return 'Unauthorized';
    }

    // Clear all caches
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    // Get environment info
    $data = [
        'app_url' => config('app.url'),
        'is_https' => request()->secure(),
        'session_driver' => config('session.driver'),
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version(),
    ];

    return response()->json($data);
});
