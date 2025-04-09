<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\AbstractServices;
use Illuminate\Http\Request;

class AbstractController extends Controller
{
    private $abstractServices;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->abstractServices = new AbstractServices();

        view()->share([
            'main_menu' => 'M2',
            'userConfig' => config('site.user'),
            'feeConfig' => getConfig('fee'),
            'workshopConfig' => $this->workshopConfig,
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.workshop.abstract.index', $this->abstractServices->indexService($request));
    }

    public function modify(Request $request)
    {
        return view("admin.workshop.abstract.modify", $this->abstractServices->modifyService($request));
    }

//    public function preview(Request $request)
//    {
//        return view("admin.workshop.abstract.preview", $this->abstractServices->popupService($request));
//    }
    public function resend(Request $request)
    {
        return view("admin.workshop.abstract.resend-mail", $this->abstractServices->popupService($request));
    }

    public function word(Request $request)
    {
        $request->merge(['word' => true]);
        return $this->abstractServices->indexService($request, $request->case ?? 'all');
    }

    public function wordPreview(Request $request)
    {
        $case = $request->case ?? 'all';
        $request->merge(['wordPreview' => true]);

        return view('admin.workshop.abstract.word-preview', $this->abstractServices->indexService($request, $case));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->abstractServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->abstractServices->dataAction($request);
    }
}
