<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ProductsController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FeaturesController;
use App\Http\Controllers\Frontend\HowToUseController;
use App\Http\Controllers\Frontend\TestimonialController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\NotFoundController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CouponController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\SettingsController;

use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Middleware\AuthCustom;
use App\Http\Middleware\DashboardAuth;



Route::get('/session-form', function () {
    return view('session-form');
})->middleware('authcustom');

Route::post('/session-save', [SessionController::class, 'save']);
Route::post('/session-update', [SessionController::class, 'update']);
Route::get('/session-delete', [SessionController::class, 'delete']);
Route::get('/session-view', [SessionController::class, 'view']);


// Route::get('/', function () {
//     $value = session()->all();
//     print_r($value);
//     echo "</pre>";
// });


// session get krva mate - $variable = session('je get krvu hoi e colunm nam');



Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [AuthController::class, 'showRegisterForm']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware(DashboardAuth::class);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');



Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware(DashboardAuth::class);

Route::get('/user-detail/{id}', [UserController::class, 'show'])
    ->name('users.detail')
    ->middleware(DashboardAuth::class);

Route::get('/user-edit/{id}', [UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware(DashboardAuth::class);

Route::put('/user-update/{id}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware(DashboardAuth::class);

Route::post('/user-delete/{id}', [UserController::class, 'destroy'])
    ->middleware(DashboardAuth::class);

Route::get('/adduser', [UserController::class, 'adduser']);

Route::post('/adduser', [UserController::class, 'store']);



Route::get('/', [HomeController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/about', [AboutController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/pages', [PagesController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/contact', [ContactController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit')
    ->middleware(DashboardAuth::class);

Route::get('/features', [FeaturesController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/how-to-use', [HowToUseController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/testimonial', [TestimonialController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/blog', [BlogController::class, 'index'])
    ->middleware(DashboardAuth::class);

Route::get('/404', [NotFoundController::class, 'index'])
    ->middleware(DashboardAuth::class);



Route::get('/products', [ProductsController::class, 'index'])
    ->name('products');

Route::get('/addproducts', [ProductsController::class, 'create'])
    ->name('products.create');

Route::post('/store-product', [ProductsController::class, 'store']);



Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])
    ->name('cart.add');

Route::get('/cart', [CartController::class, 'cart'])
    ->name('cart.view');

Route::get('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');

Route::get('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::get('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');



Route::get('/checkout', [OrderController::class, 'checkout'])
    ->name('checkout')
    ->middleware(DashboardAuth::class);

Route::post('/place-order', [OrderController::class, 'placeOrder'])
    ->name('place.order')
    ->middleware(DashboardAuth::class);

Route::get('/my-orders', [OrderController::class, 'myOrders'])
    ->name('my-orders')
    ->middleware(DashboardAuth::class);

Route::get('/order-detailsuser/{id}', [OrderController::class, 'show'])
    ->name('order.detailsuser')
    ->middleware(DashboardAuth::class);



Route::get('/admin-login', [AdminController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin-login', [AdminController::class, 'login']);

Route::middleware('admin')->group(function () {

    Route::get('/admin-dashboard', function () {
        return view('admindashboard');
    })->name('admin.dashboard');

    Route::get('/admin-logout', [AdminController::class, 'logout'])
        ->name('admin.logout');
});



Route::get('/admin/orders', [AdminController::class, 'orders'])
    ->name('admin.orders')
    ->middleware('admin');


// Route::get('/admin/orders/{id}', function($id) {
//     return view('orderdetails');
// })->name('admin.order.details');


Route::get('/admin/orders/{id}', [OrderController::class, 'orderDetails'])
    ->name('admin.order.details');

Route::post('/admin/orders/{id}/update-address', [OrderController::class, 'updateAddress'])
    ->name('admin.order.updateAddress');

Route::delete('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])
    ->name('products.delete');



Route::prefix('admin')->group(function () {

    Route::get('/order-item/increase/{id}', [OrderController::class, 'increaseQty'])
        ->name('admin.order.increase');

    Route::get('/order-item/decrease/{id}', [OrderController::class, 'decreaseQty'])
        ->name('admin.order.decrease');

    Route::get('/order-item/delete/{id}', [OrderController::class, 'deleteItem'])
        ->name('admin.order.delete');
});



Route::get('/track-order', [OrderController::class, 'trackForm'])
    ->name('track.form');

Route::post('/track-order', [OrderController::class, 'trackOrder'])
    ->name('track.order');



Route::get('/admindash', [DashboardController::class, 'index']);

Route::get('/adminproduct', [ProductController::class, 'index']);

Route::get('/adminaccounts', [AccountsController::class, 'index']);

Route::get('/adminaddproduct', [ProductController::class, 'addproduct']);



Route::post('/admin/order-status/{id}', [OrderController::class, 'updateStatus'])
    ->name('admin.order.status');



Route::get('/search', [SearchController::class, 'search'])
    ->name('search');



Route::middleware(DashboardAuth::class)->group(function () {

    Route::get('/my-account/addresses', [AccountController::class, 'addresses'])
        ->name('account.addresses');

    Route::post('/my-account/address/store', [AccountController::class, 'storeAddress'])
        ->name('account.address.store');
});



// myaccount data

Route::post('/account/address/set-primary/{id}', [AccountController::class, 'setPrimary'])
    ->name('account.address.primary');

Route::get('/account/address/edit/{id}', [AccountController::class, 'editAddress'])
    ->name('account.address.edit');

Route::post('/account/address/update/{id}', [AccountController::class, 'updateAddress'])
    ->name('account.address.update');

Route::delete('/account/address/delete/{id}', [AccountController::class, 'deleteAddress'])
    ->name('account.address.delete');


// here my account route complete



Route::middleware(DashboardAuth::class)->group(function () {

    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist');

    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');

    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])
        ->name('wishlist.destroy');
});



// use App\Http\Controllers\TestController;

// Route::get('/get-message', [TestController::class, 'getMessage']);

// Route::get('/welcome', function () {
//     return view('welcome');
// });



Route::get('send-email', [EmailController::class, 'sendEmail']);



Route::prefix('admin')->group(function () {

    Route::get('/coupons', [DiscountCodeController::class, 'index'])
        ->name('coupons.index');

    Route::get('/coupons/create', [DiscountCodeController::class, 'create'])
        ->name('coupons.create');

    Route::post('/coupons/store', [DiscountCodeController::class, 'store'])
        ->name('coupons.store');

    Route::get('coupons/edit/{id}', [DiscountCodeController::class, 'edit'])
        ->name('coupons.edit');

    Route::post('/coupons/update/{id}', [DiscountCodeController::class, 'update'])
        ->name('coupons.update');

    Route::delete('coupons/delete/{id}', [DiscountCodeController::class, 'destroy'])
        ->name('coupons.destroy');
});



Route::post('/apply-coupon', [CouponController::class, 'apply'])
    ->name('coupon.apply');

Route::post('/remove-coupon', [CouponController::class, 'remove'])
    ->name('coupon.remove');



Route::get('/account/profile', [AccountController::class, 'profile'])
    ->name('profile');

Route::post('/account/profile', [AccountController::class, 'updateProfile'])
    ->name('profile.update');



Route::get('/invoice/{id}', [OrderController::class, 'downloadInvoice'])
    ->name('invoice.download');



Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->name('password.update');
