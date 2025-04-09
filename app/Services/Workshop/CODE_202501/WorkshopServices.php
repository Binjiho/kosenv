<?php

namespace App\Services\Workshop\CODE_202501;

use App\Models\Board;
use App\Models\Workshop;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class WorkshopServices
 * @package App\Services
 */
class WorkshopServices extends AppServices
{
    public function indexService(Request $request)
    {
        $work_code = $request->work_code;

        $exceptionBoardPopup = [];
        $allCookies = $request->cookies->all();

        foreach ($allCookies as $key => $val) {
            // 게시판 팝업 오늘하루 보지않기 있는지 체크
            if (strpos($key, 'board-popup-') !== false) {
                $boardSid = (int)str_replace('board-popup-', '', $key);
                $exceptionBoardPopup[] = $boardSid;
            }
        }

        // 게시판 팝업
        $this->data['boardPopupList'] = Board::withCount('files')
            ->where(['hide' => 'N', 'popup' => 'Y'])
            ->where(['work_code'=>$work_code])
            ->whereNotIn('sid', $exceptionBoardPopup)
            ->whereHas('popups', function ($q) {
                $q->where('popup_sDate', '<=', now()->format('Y-m-d'))
                    ->where('popup_eDate', '>=', now()->format('Y-m-d'));

            })
            ->get();

        //메인 공지사항 (학술대회에 게시판이 1개라고 가정)
        $this->data['noticeList'] = Board::where(['hide' => 'N', 'work_code' => $work_code, 'main'=>'Y'])->orderbyDesc('sid')->get();

        //날짜관리
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->work_code) {
            case '202501':
                return (new CODE202501WorkshopServices())->dataAction($request);

            default:
                return notFoundRedirect();
        }
    }
}
