<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\AbstractServices;
use Illuminate\Http\Request;

class AbstractController extends Controller
{
    private $abstractServices;
    private $workshopConfig;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->abstractServices = new AbstractServices();

        view()->share([
            'feeConfig' => getConfig('fee'),
            'workshopConfig' => $this->workshopConfig,
            'work_menu' => $this->workshopConfig['work_menu'] ?? '',
            'work_code' => $work_code,
        ]);
    }

    public function check(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.check", $this->abstractServices->indexService($request));
    }

    public function index(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.index", $this->abstractServices->registService($request));
    }

    public function preview(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.preview", $this->abstractServices->indexService($request));
    }

    public function complete(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S2',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.complete", $this->abstractServices->indexService($request));
    }

    public function info(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S1',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.info", $this->abstractServices->indexService($request));
    }

    public function search(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.search", $this->abstractServices->indexService($request));
    }

    public function list(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.list", $this->abstractServices->listService($request));
    }

    public function preview_pop(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.popup.preview-pop", $this->abstractServices->indexService($request));
    }

    public function transaction(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.popup.transaction", $this->abstractServices->indexService($request));
    }
    public function receipt(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.popup.receipt", $this->abstractServices->indexService($request));
    }
    public function refund(Request $request)
    {
        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'S3',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.abstract.refund", $this->abstractServices->indexService($request));
    }


    public function data(Request $request)
    {
        return $this->abstractServices->dataAction($request);
    }
}
