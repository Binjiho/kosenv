<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\WorkshopServices;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    private $workshopServices;

    public function __construct()
    {
        $this->workshopServices = new WorkshopServices();

        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'SM1',
            'userConfig' => config('site.user'),
            'workshopConfig' => config('site.workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.workshop.index', $this->workshopServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.workshop.upsert', $this->workshopServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->workshopServices->dataAction($request);
    }
}
