<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\RegistrationServices;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationServices;
    private $workshopConfig;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->registrationServices = new RegistrationServices();

        view()->share([
            'feeConfig' => getConfig('fee'),
            'workshopConfig' => $this->workshopConfig,
            'work_menu' => $this->workshopConfig['work_menu'] ?? '',
            'work_code' => $work_code,
        ]);
    }

    public function index(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.index", $this->registrationServices->registService($request));
    }

    public function preview(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.preview", $this->registrationServices->indexService($request));
    }

    public function complete(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.complete", $this->registrationServices->indexService($request));
    }

    public function info(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S1',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.info", $this->registrationServices->indexService($request));
    }

    public function search(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.search", $this->registrationServices->indexService($request));
    }

    public function view(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.view", $this->registrationServices->indexService($request));
    }

    public function transaction(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.popup.transaction", $this->registrationServices->indexService($request));
    }
    public function receipt(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.popup.receipt", $this->registrationServices->indexService($request));
    }
    public function refund(Request $request)
    {
        view()->share([
            'main_menu' => 'M3',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.registration.refund", $this->registrationServices->indexService($request));
    }


    public function data(Request $request)
    {
        return $this->registrationServices->dataAction($request);
    }
}
