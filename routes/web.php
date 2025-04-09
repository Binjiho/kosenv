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

// intro M1
Route::controller(\App\Http\Controllers\Intro\IntroController::class)->group(function () {
    Route::get('greeting', 'greeting')->name('intro.greeting');
    Route::get('goal', 'goal')->name('intro.goal');
    Route::get('ci', 'ci')->name('intro.ci');
    Route::get('history', 'history')->where('tab', '1|2')->name('intro.history');
    Route::get('executive', 'executive')->name('intro.executive');
    Route::get('incorp', 'incorp')->where('tab', '1|2')->name('intro.incorp');
    Route::get('introduce', 'introduce')->name('intro.introduce');

    Route::post('data', 'data')->name('intro.data');
});

//학술대회 M2
Route::controller(\App\Http\Controllers\Event\EventController::class)->group(function () {
    Route::get('domestic', 'domestic')->name('event.domestic');
    Route::get('specialist', 'specialist')->name('event.specialist');

    Route::post('data', 'data')->name('event.data');
});

//학술지 및 간행물 M3
Route::controller(\App\Http\Controllers\Publication\PublicationController::class)->group(function () {
    Route::get('korean', 'korean')->where('tab', '1|2|3|4')->name('publication.korean');
    Route::get('english', 'english')->name('publication.english');

    Route::post('data', 'data')->name('publication.data');
});

//회원관련 M4
Route::controller(\App\Http\Controllers\Member\MemberController::class)->group(function () {
    Route::get('attend_check', 'attend_check')->name('member.attend_check');
    Route::get('offer', 'offer')->name('member.offer');
    Route::get('privacy', 'privacy')->name('member.privacy');
    Route::get('email', 'email')->name('member.email');

    Route::post('data', 'data')->name('member.data');
});

//저널검색 M5
Route::controller(\App\Http\Controllers\Journal\JournalController::class)->group(function () {
    Route::get('integrationSearch', 'integrationSearch')->name('journal.integrationSearch');
    Route::get('detailSearch', 'detailSearch')->name('journal.detailSearch');
    Route::get('bibList', 'bibList')->name('journal.bibList');

    Route::post('data', 'data')->name('journal.data');
});

//학회소식 M6
Route::controller(\App\Http\Controllers\News\NewsController::class)->group(function () {
    Route::get('mems', 'mems')->name('news.mems');

    Route::post('data', 'data')->name('news.data');
});

// mypage
Route::prefix('auth')->middleware('auth.check')->group(function () {
    Route::controller(\App\Http\Controllers\Mypage\MypageController::class)->prefix('mypage')->group(function () {
        Route::get('/intro', 'intro')->name('mypage.intro');
        Route::get('/password', 'password')->name('mypage.password');
        Route::get('/repassword', 'repassword')->name('mypage.repassword');
        Route::get('/withdraw', 'withdraw')->name('mypage.withdraw');
        //개인정보 수정
        Route::get('/pwCheck', 'pwCheck')->name('mypage.pwCheck');
        Route::get('/modify', 'modify')->name('mypage.modify');
        //학술대회 참석현황
        Route::get('/work_attend', 'work_attend')->name('mypage.work_attend');
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
        Route::get('info', 'info')->name('joinInfo');
        Route::middleware('guest')->group(function () {
            Route::get('{gubun}/{step}', 'join')->where('gubun', 'N|S|G')->where('step', '1|2|3')->name('join');
            Route::get('findId', 'findId')->name('findId');
            Route::get('findPw', 'findPw')->name('findPw');

        });

        Route::post('data', 'data')->name('auth.data');
    });

    Route::controller(\App\Http\Controllers\Auth\LoginController::class)->group(function () {
        Route::middleware('guest')->group(function () {
            Route::match(['get', 'post'], 'login', 'login')->name('login');
        });
        Route::post('logout', 'logout')->middleware('auth.check')->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| Workshop Routes
|--------------------------------------------------------------------------
*/
Route::controller(\App\Http\Controllers\Workshop\WorkshopController::class)->middleware('workshop.check')->prefix('workshop/{work_code?}')->group(function () {
    Route::get('/', 'index')->name('workshop');
    Route::get('/program', 'workProgram')->name('workshop.program');
    Route::get('/invite', 'workInvite')->name('workshop.invite');
    Route::get('/committee', 'workCommittee')->name('workshop.committee');
    Route::get('/directions', 'workDirections')->name('workshop.directions');
    Route::get('/accommodation', 'workAccommodation')->name('workshop.accommodation');
    Route::post('data', 'data')->name('workshop.data');

    Route::controller(\App\Http\Controllers\Workshop\RegistrationController::class)->prefix('registration')->group(function () {
        Route::get('/info', 'info')->name('registration.info');
        Route::get('/', 'index')->name('registration');
        Route::get('/preview/{sid}', 'preview')->name('registration.preview');
        Route::get('/complete/{sid}', 'complete')->name('registration.complete');
        Route::get('/search', 'search')->name('registration.search');
        Route::get('/view', 'view')->name('registration.view');
        Route::get('/transaction', 'transaction')->name('registration.transaction');
        Route::get('/receipt', 'receipt')->name('registration.receipt');
        Route::get('/refund', 'refund')->name('registration.refund');

        Route::post('data', 'data')->name('registration.data');
    });

    Route::controller(\App\Http\Controllers\Workshop\AbstractController::class)->prefix('abstract')->group(function () {
        Route::get('/info', 'info')->name('abstract.info');
        Route::get('/', 'index')->name('abstract');
        Route::get('/preview/{sid}', 'preview')->name('abstract.preview');
        Route::get('/complete/{sid}', 'complete')->name('abstract.complete');
        Route::get('/check', 'check')->name('abstract.check');
        Route::get('/search', 'search')->name('abstract.search');
        Route::get('/list', 'list')->name('abstract.list');
        Route::get('/preview_pop/{sid}', 'preview_pop')->name('abstract.preview_pop');

        Route::post('data', 'data')->name('abstract.data');
    });

    Route::controller(\App\Http\Controllers\Workshop\SupportController::class)->prefix('support')->group(function () {
        Route::get('/info', 'info')->name('support.info');
        Route::get('/', 'index')->name('support');
        Route::get('/preview/{sid}', 'preview')->name('support.preview');
        Route::get('/complete/{sid}', 'complete')->name('support.complete');
        Route::get('/check', 'check')->name('support.check');
        Route::get('/search', 'search')->name('support.search');
        Route::get('/view', 'view')->name('support.view');

        Route::post('data', 'data')->name('support.data');
    });
});

require __DIR__ . '/common.php';
