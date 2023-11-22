<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CheckoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[WebsiteController::class,'index'])->name('home');
Route::get('/contact-us',[WebsiteController::class,'contact'])->name('contact-us');
Route::get('/refer-earn',[WebsiteController::class,'referEarn'])->name('refer-earn');
Route::get('/faq',[WebsiteController::class,'faq'])->name('faq');

//Product on Home Page
Route::get('/product-detail/{id}',[WebsiteController::class,'productDetail'])->name('product.detail');
Route::post('/product-review/{id}',[WebsiteController::class,'productReview'])->name('product.review');

//Customer Module
Route::get('/customer',[CustomerController::class,'index'])->name('customer');
Route::post('/customer-login',[CustomerController::class,'login'])->name('customer.login');
Route::get('/customer-logout',[CustomerController::class,'logout'])->name('customer.logout');
Route::post('/customer-register',[CustomerController::class,'register'])->name('customer.register');
Route::get('/customer-profile',[CustomerController::class,'profile'])->name('customer.profile');
Route::post('/customer-update',[CustomerController::class,'update'])->name('customer.update');
Route::get('/customer-dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');
Route::get('/customer-order',[CustomerController::class,'order'])->name('customer.order');
Route::get('/customer-payment',[CustomerController::class,'payment'])->name('customer.payment');
Route::get('/customer-review',[CustomerController::class,'review'])->name('customer.review');
Route::get('/customer-change-password',[CustomerController::class,'changePassword'])->name('customer.change.password');


//Checkout Module
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');


//Cart Module
Route::post('/cart-add/{id}',[CartController::class,'cartAdd'])->name('cart.add');
Route::get('/cart-show',[CartController::class,'cartShow'])->name('cart.show');
Route::get('/cart-destroy',[CartController::class,'cartDestroy'])->name('cart.destroy');
Route::get('/cart-delete/{rowId}',[CartController::class,'cartDelete'])->name('cart.delete');
Route::post('/cart-update/{rowId}',[CartController::class,'cartUpdate'])->name('cart.update');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');

//    Category Module
    Route::get('/category/manage',[CategoryController::class,'index'])->name('category.manage');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

    //    Sub Category Module
    Route::get('/sub-category/manage',[SubCategoryController::class,'index'])->name('sub-category.manage');
    Route::get('/sub-category/create',[SubCategoryController::class,'create'])->name('sub-category.create');
    Route::post('/sub-category/store',[SubCategoryController::class,'store'])->name('sub-category.store');
    Route::get('/sub-category/edit/{id}',[SubCategoryController::class,'edit'])->name('sub-category.edit');
    Route::post('/sub-category/update/{id}',[SubCategoryController::class,'update'])->name('sub-category.update');
    Route::get('/sub-category/delete/{id}',[SubCategoryController::class,'delete'])->name('sub-category.delete');

    //    Brand Module
    Route::get('/brand/manage',[BrandController::class,'index'])->name('brand.manage');
    Route::get('/brand/create',[BrandController::class,'create'])->name('brand.create');
    Route::post('/brand/store',[BrandController::class,'store'])->name('brand.store');
    Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}',[BrandController::class,'update'])->name('brand.update');
    Route::get('/brand/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');

    //    Unit Module
    Route::get('/unit/manage',[UnitController::class,'index'])->name('unit.manage');
    Route::get('/unit/create',[UnitController::class,'create'])->name('unit.create');
    Route::post('/unit/store',[UnitController::class,'store'])->name('unit.store');
    Route::get('/unit/edit/{id}',[UnitController::class,'edit'])->name('unit.edit');
    Route::post('/unit/update/{id}',[UnitController::class,'update'])->name('unit.update');
    Route::get('/unit/delete/{id}',[UnitController::class,'delete'])->name('unit.delete');

    //Courier Module
    Route::get('/courier/create',[CourierController::class,'create'])->name('courier.create');
    Route::post('/courier/store',[CourierController::class,'store'])->name('courier.store');
    Route::get('/courier/manage',[CourierController::class,'index'])->name('courier.manage');
    Route::get('/courier/edit/{id}',[CourierController::class,'edit'])->name('courier.edit');
    Route::post('/courier/update/{id}',[CourierController::class,'update'])->name('courier.update');
    Route::get('/courier/delete/{id}',[CourierController::class,'delete'])->name('courier.delete');

    Route::resource('product',ProductController::class);
    Route::get('/get-sub-category-by-category', [ProductController::class, 'getCategoryBySubCategory'])->name('get-sub-category-by-category');
});
