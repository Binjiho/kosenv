<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\WorkshopServices;
use Illuminate\Http\Request;
use App\Models\Workshop;

class WorkshopController extends Controller
{
    private $workshopServices;
    private $workshopConfig;

    public function __construct()
    {
        $work_code = request()->work_code ?? '';
        if(!empty($work_code)){
            $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        }
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->workshopServices = new WorkshopServices();

        view()->share([
            'workshopConfig' => $this->workshopConfig,
            'work_menu' => $this->workshopConfig['work_menu'] ?? '',
            'work_code' => $work_code,
            'workshop' => $workshop ?? '',
        ]);
    }

    public function index(Request $request)
    {
        view()->share([
            'main_menu' => 'main',
            'sub_menu' => '',
        ]);

        return view("workshop.{$this->workshopConfig['work_code']}.index", $this->workshopServices->indexService($request));
    }

    public function workInvite(Request $request)
    {
        view()->share([
            'main_menu' => 'M1',
            'sub_menu' => 'S1',
        ]);
        return view("workshop.{$this->workshopConfig['work_code']}.about.invite");
    }
    public function workCommittee(Request $request)
    {
        view()->share([
            'main_menu' => 'M1',
            'sub_menu' => 'S2',
        ]);
        return view("workshop.{$this->workshopConfig['work_code']}.about.committee");
    }

    public function workProgram(Request $request)
    {
        view()->share([
            'main_menu' => 'M2',
            'sub_menu' => 'S1',
        ]);
        return view("workshop.{$this->workshopConfig['work_code']}.program.index");
    }


    public function workDirections(Request $request)
    {
        view()->share([
            'main_menu' => 'M6',
            'sub_menu' => 'S1',
        ]);
        return view("workshop.{$this->workshopConfig['work_code']}.introduce.directions");
    }

    public function workAccommodation(Request $request)
    {
        view()->share([
            'main_menu' => 'M6',
            'sub_menu' => 'S2',
        ]);
        return view("workshop.{$this->workshopConfig['work_code']}.introduce.accommodation");
    }

    public function data(Request $request)
    {
        return $this->workshopServices->dataAction($request);
    }
}
