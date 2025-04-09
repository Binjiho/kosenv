<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Services\Board\BoardServices;
use Illuminate\Http\Request;
use App\Models\Workshop;

class BoardController extends Controller
{
    private $boardServices;
    private $boardConfig;

    public function __construct()
    {
        $code = request()->code ?? '';
        $this->boardConfig = getConfig("board")[$code] ?? [];
        $this->boardServices = new BoardServices();

        $work_code = $this->boardConfig['work_code'] ?? '';
        if(!empty($work_code)){
            $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        }
        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];

        view()->share([
            'boardConfig' => $this->boardConfig,
            'main_menu' => $this->boardConfig['menu']['main'] ?? '',
            'sub_menu' => $this->boardConfig['menu']['sub'] ?? '',
            'code' => $code,
            'work_code' => $work_code,
            'workshop' => $workshop ?? '',
            'work_menu' => $this->workshopConfig['work_menu'] ?? '',
        ]);
    }

    public function index(Request $request)
    {
        return view("board.{$this->boardConfig['skin']}.index", $this->boardServices->listService($request));
    }

    public function view(Request $request)
    {
        return view("board.{$this->boardConfig['skin']}.view", $this->boardServices->viewService($request));
    }

    public function upsert(Request $request)
    {
        return view("board.{$this->boardConfig['skin']}.upsert", $this->boardServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->boardServices->dataAction($request);
    }
}
