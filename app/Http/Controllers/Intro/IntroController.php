<?php

namespace App\Http\Controllers\Intro;

use App\Http\Controllers\Controller;
//use App\Services\Intro\IntroServices;
use Illuminate\Http\Request;

class IntroController extends Controller
{
    public function __construct()
    {

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M1',
        ]);
    }

    public function greeting(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('intro.greeting');
    }

    public function goal(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('intro.goal');
    }
    public function ci(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('intro.ci');
    }
    public function history(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);
        return view('intro.history'.$request->tab ?? 1);
    }
    public function executive(Request $request)
    {
        view()->share(['sub_menu' => 'S5']);
        return view('intro.executive');
    }
    public function incorp(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('intro.incorp'.$request->tab ?? 1);
    }
    public function introduce(Request $request)
    {
        view()->share(['sub_menu' => 'S7']);
        return view('intro.introduce');
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
