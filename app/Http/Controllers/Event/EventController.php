<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
//use App\Services\Workshop\WorkshopServices;
use Illuminate\Http\Request;

class EventController extends Controller
{
//    private $mypageServices;

    public function __construct()
    {
//        $this->mypageServices = (new MypageServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M2',
        ]);
    }

    public function domestic(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('event.domestic.list');
    }
public function specialist(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('event.specialist.list');
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
