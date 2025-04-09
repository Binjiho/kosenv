<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\SupportServices;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    private $supportServices;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->supportServices = new SupportServices();

        view()->share([
            'main_menu' => 'M2',
            'userConfig' => config('site.user'),
            'feeConfig' => getConfig('fee'),
            'workshopConfig' => $this->workshopConfig,
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.workshop.support.index', $this->supportServices->indexService($request));
    }

    public function modify(Request $request)
    {
        return view("admin.workshop.support.modify", $this->supportServices->modifyService($request));
    }
    public function resend(Request $request)
    {
        return view("admin.workshop.support.resend-mail", $this->supportServices->popupService($request));
    }


    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->supportServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->supportServices->dataAction($request);
    }
}
