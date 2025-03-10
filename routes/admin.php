<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Admin\Main\MainController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::post('data', 'data')->name('main.data');
});

// member
Route::controller(\App\Http\Controllers\Admin\Member\MemberController::class)->prefix('member')->group(function () {
    Route::get('/', 'index')->name('member');
    Route::get('upsert/{sid}', 'upsert')->name('member.upsert');
    Route::get('popup/search', 'popupSearch')->name('member.popup.search');
    
    Route::get('excel', 'excel')->name('member.excel');
    Route::post('data', 'data')->name('member.data');
});

// 회비관리
Route::controller(\App\Http\Controllers\Admin\Fee\FeeController::class)->prefix('fee')->group(function () {
    Route::get('/{case?}', 'index')->where('case', 'full|unpaid')->name('fee');
//    Route::get('popup/mail/{sid}/{type}', 'popupMail')->name('fee.popup.mail');
    Route::get('popup/all-list/{user_sid}', 'allList')->name('fee.popup.all-list');
    Route::get('upsert/{sid?}', 'upsert')->name('fee.upsert');
    Route::get('transaction/{sid?}', 'transaction')->name('fee.transaction');
    Route::get('receipt/{sid?}', 'receipt')->name('fee.receipt');
    Route::get('excel/{case?}', 'excel')->where('case', 'full|unpaid')->name('fee.excel');
    Route::post('data', 'data')->name('fee.data');
});

// 메일
Route::prefix('mail')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\Mail\MailController::class)->group(function () {
        Route::get('/', 'index')->name("mail");
        Route::get('detail/{sid}', 'detail')->name("mail.detail");
        Route::get('upsert/{sid?}', 'upsert')->name("mail.upsert");
        Route::get('preview/{sid}', 'preview')->name("mail.preview");
        Route::post('data', 'data')->name('mail.data');
    });

    Route::controller(\App\Http\Controllers\Admin\Mail\MailAddressController::class)->prefix('address')->group(function () {
        Route::get('/', 'index')->name("mail.address");
        Route::get('upsert/{sid?}', 'upsert')->name("mail.address.upsert");

        Route::prefix('detail')->group(function () {
            Route::get('{ma_sid}', 'detail')->name("mail.address.detail");
            Route::get('{ma_sid}/upsert-{type}/{sid?}', 'detailUpsert')->name("mail.address.detail.upsert");
        });

        Route::post('data', 'data')->name('mail.address.data');
    });
});

// 접속통계
Route::controller(\App\Http\Controllers\Admin\Stat\StatController::class)->prefix('stat')->group(function () {
    Route::get('/', 'index')->name("stat");
    Route::get('referer', 'referer')->name("stat.referer");
    Route::get('data', 'data')->name("stat.data");
});

// auth
Route::controller(\App\Http\Controllers\Admin\Auth\LoginController::class)->prefix('auth')->group(function () {
    Route::post('logout', 'logout')->name('logout');
});

require __DIR__ . '/common.php';
