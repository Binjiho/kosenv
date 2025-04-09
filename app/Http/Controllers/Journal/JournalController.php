<?php

namespace App\Http\Controllers\Journal;

use App\Http\Controllers\Controller;
//use App\Services\Journal\JournalServices;
use Illuminate\Http\Request;

class JournalController extends Controller
{
//    private $mypageServices;

    public function __construct()
    {
//        $this->mypageServices = (new MypageServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M5',
        ]);
    }

    public function integrationSearch(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('journal.integrationSearch');
    }
    public function detailSearch(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('journal.detailSearch');
    }
    public function bibList(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('journal.bibList');
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
