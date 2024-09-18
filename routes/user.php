<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => 'user'],function(){
    Route::get('home',[UserController::class,'userHome'])->name('userHome');

    //user profile
    Route::group(['prefix' => 'profile'],function(){
        Route::get('',[UserController::class,'userProfile'])->name('userProfile');
        Route::get('edit',[UserController::class,'userEditPage'])->name('userEditPage');
        Route::post('edit',[UserController::class,'userEdit'])->name('userEdit');

        //change password
        Route::get('changePassword',[UserController::class,'changePasswordPage'])->name('changePasswordPage');
        Route::post('changePassword',[UserController::class,'changePassword'])->name('changePassword');

        
    });
}); 