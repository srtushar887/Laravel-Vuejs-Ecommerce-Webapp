<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\FrontendController::class,'index'])->name('front');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::prefix('admin')->group(function (){
    Route::get('/login', [\App\Http\Controllers\Auth\AdminLoginController::class,'showLoginform'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class,'login'])->name('admin.login.submit');

    Route::get('/logout', [\App\Http\Controllers\Auth\AdminLoginController::class,'logout'])->name('admin.logout');
});


Route::group(['middleware' => ['auth:admin']], function() {
    Route::prefix('admin')->group(function() {


//        Route::get('/{vue?}', [\App\Http\Controllers\Admin\AdminController::class,'index'])->where('vue', '[\/\w\.-]*');
        Route::any('/{slug}', [\App\Http\Controllers\Admin\AdminController::class,'index'])->name('test');
//        Route::get('/{any}', function () {
//            return view('layouts.admin');
//        })->where('any', '^(?!admin).*');

        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin.dashboard');

        //main category
        Route::get('/get/category', [\App\Http\Controllers\Admin\AdminCategoryController::class,'get_category'])->name('admin.get.category');
        Route::post('/save/category', [\App\Http\Controllers\Admin\AdminCategoryController::class,'save_category'])->name('admin.save.category');
        Route::post('/update/category/{id}', [\App\Http\Controllers\Admin\AdminCategoryController::class,'update_category'])->name('admin.update.category');
        Route::get('/delete/category/{id}', [\App\Http\Controllers\Admin\AdminCategoryController::class,'delete_category'])->name('admin.delete.category');


        //sub category
        Route::get('/get/all/category', [\App\Http\Controllers\Admin\AdminCategoryController::class,'get_all_category'])->name('admin.get.allcategory');
        Route::get('/get/all/subcategory', [\App\Http\Controllers\Admin\AdminCategoryController::class,'get_all_sub_category'])->name('admin.get.allsubcategory');
        Route::post('/save/subcategory', [\App\Http\Controllers\Admin\AdminCategoryController::class,'save_sub_category'])->name('admin.save.subcategory');
        Route::post('/update/subcategory/{id}', [\App\Http\Controllers\Admin\AdminCategoryController::class,'update_sub_category'])->name('admin.update.subcategory');
        Route::get('/delete/subcategory/{id}', [\App\Http\Controllers\Admin\AdminCategoryController::class,'delete_sub_category'])->name('admin.delete.subcategory');


        //product
        Route::get('/product/all/category', [\App\Http\Controllers\Admin\AdminProductController::class,'get_product_all_category'])->name('admin.product.allcategory');
        Route::get('/product/all/subcategory', [\App\Http\Controllers\Admin\AdminProductController::class,'get_product_all_sub_category'])->name('admin.product.allsubcategory');
        Route::get('/get/all/products', [\App\Http\Controllers\Admin\AdminProductController::class,'get_all_products'])->name('admin.product.get.all');
        Route::post('/save/product', [\App\Http\Controllers\Admin\AdminProductController::class,'save_product'])->name('admin.save.product');
        Route::get('/product/details/{id}', [\App\Http\Controllers\Admin\AdminProductController::class,'product_details'])->name('admin.product.details');
        Route::post('/update/product/{id}', [\App\Http\Controllers\Admin\AdminProductController::class,'product_update'])->name('admin.product.details');
        Route::get('/product/delete/{id}', [\App\Http\Controllers\Admin\AdminProductController::class,'product_delete'])->name('admin.product.delete');



    });
});
