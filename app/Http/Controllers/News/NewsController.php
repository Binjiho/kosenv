<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
//use App\Services\News\NewsServices;
use Illuminate\Http\Request;

class NewsController extends Controller
{
//    private $mypageServices;

    public function __construct()
    {
//        $this->mypageServices = (new MypageServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M6',
        ]);
    }

    public function mems(Request $request)
    {
        view()->share(['sub_menu' => 'S7']);
        return view('news.mems');
    }

//    public function greeting(Request $request)
//    {
//        view()->share(['sub_menu' => 'S1']);
//        return view('mypage.greeting', $this->mypageServices->indexService($request));
//    }

//    public function data(Request $request)
//    {
//        return $this->mypageServices->dataAction($request);
//    }
}
