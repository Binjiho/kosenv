<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
//use App\Services\Publication\PublicationServices;
use Illuminate\Http\Request;

class PublicationController extends Controller
{

    public function __construct()
    {
        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M3',
            'workshop' => $workshop ?? '',
        ]);
    }

    public function korean(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('publication.korean.index'.$request->tab ?? 1);
    }
    public function korean_greeting(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('publication.korean.greeting');
    }
    public function korean_committee(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('publication.korean.committee');
    }
    public function korean_vote(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('publication.korean.vote');
    }

    public function english(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('publication.english.index');
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
