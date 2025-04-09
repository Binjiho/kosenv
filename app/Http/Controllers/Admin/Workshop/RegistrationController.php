<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\RegistrationServices;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationServices;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->registrationServices = new RegistrationServices();

        view()->share([
            'main_menu' => 'M2',
            'userConfig' => config('site.user'),
            'feeConfig' => getConfig('fee'),
            'workshopConfig' => $this->workshopConfig,
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.workshop.registration.index", $this->registrationServices->indexService($request));
    }

    public function modify(Request $request)
    {
        return view("admin.workshop.registration.modify", $this->registrationServices->modifyService($request));
    }

    public function preview(Request $request)
    {
        return view("admin.workshop.registration.preview", $this->registrationServices->popupService($request));
    }
    public function receipt(Request $request)
    {
        return view("workshop.{$request->work_code}.registration.popup.receipt", $this->registrationServices->popupService($request));
    }
    public function transaction(Request $request)
    {
        return view("workshop.{$request->work_code}.registration.popup.transaction", $this->registrationServices->popupService($request));
    }
    public function memo(Request $request)
    {
        return view("admin.workshop.registration.memo", $this->registrationServices->popupService($request));
    }
    public function resend(Request $request)
    {
        return view("admin.workshop.registration.resend-mail", $this->registrationServices->popupService($request));
    }
//    public function search(Request $request)
//    {
//        return view("workshop.{$request->work_code}.registration.search", $this->registrationServices->popupService($request));
//    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->registrationServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->registrationServices->dataAction($request);
    }
}
