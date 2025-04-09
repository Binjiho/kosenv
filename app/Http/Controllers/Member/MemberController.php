<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
//use App\Services\Member\MemberServices;
use Illuminate\Http\Request;

class MemberController extends Controller
{
//    private $mypageServices;

    public function __construct()
    {
//        $this->mypageServices = (new MypageServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M4',
        ]);
    }

    public function attend_check(Request $request)
    {
        view()->share(['sub_menu' => 'S5']);
        return view('member.attend_check');
    }
    public function offer(Request $request)
    {
        view()->share(['sub_menu' => 'S7']);
        return view('member.offer');
    }
    public function privacy(Request $request)
    {
        view()->share(['sub_menu' => 'S8']);
        return view('member.privacy');
    }
    public function email(Request $request)
    {
        view()->share(['sub_menu' => 'S9']);
        return view('member.email');
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
