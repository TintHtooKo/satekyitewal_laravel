<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'],function(){

    Route::get('home',[AdminController::class,'adminHome'])->name('adminHome');

    // category
    Route::group(['prefix' => 'category'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('categoryList');
        Route::post('create',[CategoryController::class,'create'])->name('categoryCreate');
        Route::get('update/{id}',[CategoryController::class,'updatePage'])->name('categoryUpdatePage');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('categoryUpdate');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('categoryDelete');
    });

    // profile
    Route::group(['prefix' => 'profile'],function(){
        Route::get('/changePassword',[ProfileController::class,'changePasswordPage'])->name('changePasswordPage');
        Route::post('/changePassword',[ProfileController::class,'changePassword'])->name('changePassword');

        Route::get('profile',[ProfileController::class,'profile'])->name('profileAccount');
        Route::get('edit',[ProfileController::class,'editProfilePage'])->name('editProfilePage');
        Route::post('edit',[ProfileController::class,'editProfile'])->name('editProfile');

        Route::group(['middleware' => 'superadmin'],function(){
            //add new admin acc
            Route::get('add/newadmin',[ProfileController::class,'addNewAdminPage'])->name('addNewAdminPage');
            Route::post('add/newadmin',[ProfileController::class,'addNewAdmin'])->name('addNewAdmin'); 
            Route::get('admin/list',[ProfileController::class,'adminList'])->name('adminList'); 
            Route::get('admin/delete/{id}',[ProfileController::class,'adminDelete'])->name('adminDelete');

            //add new user acc
            Route::get('user/list',[ProfileController::class,'userList'])->name('userList');
            Route::get('add/newuser',[ProfileController::class,'addNewUserPage'])->name('addNewUserPage');
            Route::post('add/newuser',[ProfileController::class,'addNewUser'])->name('addNewUser');
            Route::get('user/delete/{id}',[ProfileController::class,'userDelete'])->name('userDelete');
        });
    });

    // payment
    Route::group(['middleware' => 'superadmin'],function(){
        Route::group(['prefix' => 'payment'],function(){
            Route::get('list',[PaymentController::class,'payment'])->name('payment');
            Route::post('create',[PaymentController::class,'paymentCreate'])->name('paymentCreate');
            Route::get('delete/{id}',[PaymentController::class,'paymentDelete'])->name('paymentDelete');
            Route::get('update/{id}',[PaymentController::class,'paymentUpdatePage'])->name('paymentUpdatePage');
            Route::post('update/{id}',[PaymentController::class,'paymentUpdate'])->name('paymentUpdate');
        });
    });

    // Product
    Route::group(['prefix' => 'product'],function(){
        Route::get('create',[ProductController::class,'createPage'])->name('createPage');
        Route::post('create',[ProductController::class,'create'])->name('createProduct');
        Route::get('list/{amt?}',[ProductController::class,'productList'])->name('productList');
        Route::get('update/{id}',[ProductController::class,'updateProductPage'])->name('updateProductPage');
        // update ko id nae ma lote yin blade mhr hidden nae id u
        Route::post('update/',[ProductController::class,'updateProduct'])->name('updateProduct');
        Route::get('detail/{id}',[ProductController::class,'detailProduct'])->name('detailProduct');
        Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct');
    });
}); 