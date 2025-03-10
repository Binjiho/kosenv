<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Main\MainController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::post('data', 'data')->name('main.data');
});

// mypage
Route::prefix('auth')->middleware('auth.check')->group(function () {
    Route::controller(\App\Http\Controllers\Mypage\MypageController::class)->group(function () {
        Route::get('/intro', 'intro')->name('mypage.intro');
        Route::get('/password', 'password')->name('mypage.password');
        Route::get('/repassword', 'repassword')->name('mypage.repassword');
        Route::get('/withdraw', 'withdraw')->name('mypage.withdraw');
        //개인정보 수정
        Route::get('/pwCheck', 'pwCheck')->name('mypage.pwCheck');
        Route::get('/modify', 'modify')->name('mypage.modify');

        Route::post('MyPagedata', 'MyPagedata')->name('mypage.data');
    });

    //Fee
    Route::controller(\App\Http\Controllers\Mypage\FeeController::class)->group(function () {
        Route::get('/fee', 'fee')->name('mypage.fee');
        Route::get('/upsert', 'upsert')->name('mypage.fee.upsert');
        Route::get('/transaction', 'transaction')->name('mypage.fee.transaction');
        Route::get('/receipt', 'receipt')->name('mypage.fee.receipt');

        Route::post('Feedata', 'Feedata')->name('fee.data');
    });
});

// auth
Route::prefix('auth')->group(function () {
    Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('info', 'info')->name('joinInfo');
            Route::get('{gubun}/{step}', 'join')->where('gubun', 'N|S|G')->where('step', '1|2|3')->name('join');
            Route::get('findId', 'findId')->name('findId');
            Route::get('findPw', 'findPw')->name('findPw');

        });

        Route::post('data', 'data')->name('auth.data');
    });

    Route::controller(\App\Http\Controllers\Auth\LoginController::class)->group(function () {
        Route::match(['get', 'post'], 'login', 'login')->middleware('guest')->name('login');
        Route::post('logout', 'logout')->middleware('auth.check')->name('logout');
    });
});

require __DIR__ . '/common.php';
