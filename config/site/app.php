<?php

return [
    // ================== asset version ==================
    'asset_version' => '20230605',

    // ================== master ip (password 체크 무시) ==================
    'masterIp' => [
        '218.235.94.247',
        '218.235.94.252', //혜원씨 결제 테스트 때문에 추가
    ],

    // ================== debug ip (debugbar 노출) ==================
    'debugIp' => [
        '218.235.94.247',
    ],

    // ================== dev ip (error 페이지 노출) ==================
    'devIp' => [
        '218.235.94.247',
    ],

    // ================= api =================
    'api' => [
        'url' => env('APP_URL') . '/api',
    ],

    // ================= web =================
    'web' => [
        'app_name' => env('APP_NAME'),
        'url' => env('APP_URL'),
    ],
    
    // ================= admin =================
    'admin' => [
        'app_name' => '관리자 | ' . env('APP_NAME'),
        'url' => env('APP_URL') . '/admin',
    ],

    'info' => [
        'address' => '',
        'email' => '',
        'tel' => '',
        'fax' => '',
    ],
];
