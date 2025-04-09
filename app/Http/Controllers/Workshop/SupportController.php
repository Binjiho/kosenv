<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\SupportServices;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    private $supportServices;
    private $workshopConfig;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->supportServices = new SupportServices();

        view()->share([
            'workshopConfig' => $this->workshopConfig,
            'work_menu' => $this->workshopConfig['work_menu'] ?? '',
            'work_code' => $work_code,
        ]);
    }

    public function index(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.index", $this->supportServices->indexService($request));
    }

    public function preview(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.preview", $this->supportServices->indexService($request));
    }

    public function complete(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.complete", $this->supportServices->indexService($request));
    }

    public function info(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S1',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.info", $this->supportServices->indexService($request));
    }

    public function search(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.search", $this->supportServices->indexService($request));
    }

    public function view(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.search-view", $this->supportServices->indexService($request));
    }

    public function preview_pop(Request $request)
    {
        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.support.popup.preview-pop", $this->supportServices->indexService($request));
    }



    public function data(Request $request)
    {
        return $this->supportServices->dataAction($request);
    }
}
