<?php


use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TempImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



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

Route::get('/', function () {
    return view('welcome');
});



// ============================ Front Routes ===============================
Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});



// ============================ Admin Routes ===============================

Route::group(["prefix" => "dashboard"], function () {

    // Registration and Login Authentication Middlewate for Admin Start

    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/login', 'index')->name('admin.login');
        Route::post('/authenticate', 'authenticate')->name('admin.authenticate');
    });

    // Registration and Login Authentication Middlewate for Admin End


    // Authentication and Authorization Middleware for Admin Start
    Route::middleware(['middleware' => 'auth_admin'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('admin.dashboard');
            Route::get('/logout', 'logout')->name('admin.logout');
        });

        // Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        //     Route::get('', 'index')->name('categories.index');
        //     Route::get('create', 'create')->name('categories.create');
        //     Route::get('edit/{id}', 'edit')->name('categories.edit');
        //     Route::post('store', 'store')->name('categories.store');
        //     Route::delete('delete/{id}', 'destroy')->name('categories.delete');
        // });

        Route::controller(SubCategoryController::class)->prefix('categories')->group(function () {
            Route::get('', 'index')->name('subcategories.index');
            Route::get('create', 'create')->name('subcategories.create');
            Route::get('edit/{id}', 'edit')->name('subcategories.edit');
            Route::post('store', 'store')->name('subcategories.store');
            Route::delete('delete/{id}', 'destroy')->name('subcategories.delete');
            // Update Product Controller Image
            Route::post('sub_category_image/update', 'updateSubCategoryImage')->name('subcategories.updateImage');
            Route::delete('sub_category_image', 'deleteSubCategoryImage')->name('subcategories.deleteImage');
        });

        Route::controller(ProductController::class)->prefix('products')->group(function () {
            Route::get('', 'index')->name('product.index');
            Route::get('create', 'create')->name('product.create');
            Route::get('edit/{id}', 'edit')->name('product.edit');
            Route::post('store', 'store')->name('product.store');
            Route::delete('delete/{id}', 'destroy')->name('product.delete');

            // Update Product Controller Image
            Route::post('product_image/update', 'updateProductImage')->name('products.updateImage');
            Route::delete('product_image', 'deleteProductImage')->name('products.deleteImage');
        });

        // Order Details 
        Route::controller(OrderController::class)->prefix('orders')->group(function () {
            Route::get('', 'index')->name('orders.index');
            Route::get('edit/{id}', 'edit')->name('orders.edit');
            Route::delete('delete/{id}', 'destroy')->name('orders.delete');
            Route::post('change_status/{id}', 'changeOrderStatus')->name('orders.changeOrderStatus');
            Route::post('send_email_invoice/{id}', 'sendEmailInvoice')->name('orders.sendEmailInvoice');
        });


        // Shipping Routes
        Route::controller(ShippingController::class)->prefix('shipping')->group(function () {
            Route::get('/create', 'create')->name('shipping.create');
            Route::post('/store', 'store')->name('shipping.store');
            Route::get('edit/{id}', 'edit')->name('shipping.edit');
            Route::put('update/{id}', 'update')->name('shipping.update');
            Route::delete('delete/{id}', 'destroy')->name('shipping.delete');
        });


        // Temperory Images route
        Route::post('/upload_image', [TempImageController::class, 'create'])->name('image.create');
        Route::delete('/delete_image/{id}', [TempImageController::class, 'deleteImage'])->name('delete.image');

        Route::get('/getSlug', function (Request $request) {
            $slug = "";
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }

            return response()->json([
                "status" => true,
                "slug" => $slug,
            ]);
        })->name('getSlug');
    });

    // Authentication and Authorization Middleware for Admin End
});