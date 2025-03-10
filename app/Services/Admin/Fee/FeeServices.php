<?php

namespace App\Services\Admin\Fee;

use App\Models\Fee;
use App\Models\FeeSetting;
use App\Exports\FeeExcel;
use App\Models\User;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class FeeServices
 * @package App\Services
 */
class FeeServices extends AppServices
{
    public function indexService(Request $request)
    {
        $li_page = $request->li_page ?? 20;
        $feeCase = $request->case;

        $level = $request->level;
        $id = $request->id;
        $name_kr = $request->name_kr;

        $year = $request->year;
        $category = $request->category;
        $payment_method = $request->payment_method;
        $payment_status = $request->payment_status;

        $query = Fee::with('user')->orderByDesc('year')->orderByDesc('sid');

        switch ($feeCase) {
            case 'full':
                $excelName = '완납회비';
                $query->where('payment_status', 'Y');
                break;

            case 'unpaid':
                $excelName = '미납회비';
                $query->whereIn('payment_status', ['N', 'R']);
                break;
        }

        if ($level) {
            $query->whereHas('user', function ($q) use($level) {
                $q->where('level', $level);
            });
        }

        if ($id) {
            $query->whereHas('user', function ($q) use($id) {
                $q->where('id', 'like', "%{$id}%");
            });
        }

        if ($name_kr) {
            $query->whereHas('user', function ($q) use($name_kr) {
                $q->where('name_kr', 'like', "%{$name_kr}%")
                    ->orWhere('name_en', 'like', "%{$name_kr}%");
            });
        }

        if ($year) {
            $query->where('year', $year);
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($payment_method) {
            $query->where('payment_method', $payment_method);
        }

        if ($payment_status) {
            $query->where('payment_status', $payment_status);

        }
        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            return (new CommonServices())->excelDownload(new FeeExcel($this->data), date('Y-m-d').'_'.($excelName ?? '전체 회비'));
        }

        $list = $query->paginate($li_page);

        $this->data['list'] = setListSeq($list);
        $this->data['li_page'] = $li_page;
        $this->data['feeCase'] = empty($feeCase) ? [] : ['case' => $feeCase];

        return $this->data;
    }

//    public function popupMailService(Request $request)
//    {
//        $this->data['fee'] = Fee::withTrashed()->findOrFail($request->sid);
//        $this->data['type'] = $request->type;
//
//        return $this->data;
//    }

    public function allListService(Request $request)
    {
        $user = User::withTrashed()->findOrFail($request->user_sid);
        $list = $user->fees()->paginate(10);

        $this->data['user'] = $user;
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid;

        if (!empty($sid)) {
            $this->data['fee'] = Fee::with('user')->findOrFail($sid);
        }

        if(!empty($request->user_sid)){
            $user = User::withTrashed()->findOrFail($request->user_sid);
            $this->data['user'] = $user;
        }

        return $this->data;
    }

    public function transactionService(Request $request)
    {
        $user_sid = $request->user_sid;
        $this->data['user'] = User::findOrFail($user_sid);
        $fee_list = Fee::where([
            'tid' => $request->tid,
            'user_sid' => $user_sid,
            'payment_status' => 'Y',
        ])->get();

        $this->data['fee_list'] = $fee_list;

        $tot_price = 0;
        foreach ($fee_list as $fee){
            $tot_price += $fee->price;
        }
        $this->data['tot_price'] = $tot_price;

        return $this->data;
    }
    public function receiptService(Request $request)
    {
        $this->feeConfig = getConfig('fee');

        $user_sid = $request->user_sid;
        $this->data['user'] = User::findOrFail($user_sid);

        $fee_list = Fee::where([
            'tid' => $request->tid,
            'user_sid' => $user_sid,
            'payment_status' => 'Y',
        ])->get();

        $this->data['fee_list'] = $fee_list;

        $target_category = array();
        $target_price = 0;
        foreach ($fee_list as $fee){
            $target_category[] = $this->feeConfig['category'][$fee->category] ?? '';
            $target_price += $fee->price;
        }
        $this->data['target_category'] = implode(',',$target_category);
        $this->data['target_price'] = $target_price;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'fee-create':
                return $this->feeCreate($request);

            case 'fee-update':
                return $this->feeUpdate($request);

            case 'fee-delete':
                return $this->feeDelete($request);

            case 'change-payment_status':
                return $this->changePaymentStatus($request);

            case 'fee-renew':
                return $this->feeRenew($request);

            default:
                return notFoundRedirect();
        }
    }

    private function feeCreate(Request $request)
    {
        $this->transaction();

        try {
            $fee = new Fee();
            $fee->setByData($request);
            $fee->save();

            /**
             * tid가 없는 상태인데 넣으려할때 random값 넣기
             */
            if(empty($fee->tid) && $request->payment_status == 'Y'){
                $random = substr(Str::uuid(), 0, 15);
                $fee->tid='admin'.$random;
            }
            $fee->timestamps = false; // updated_at 자동 갱신 비활성화
            $fee->update();

            $this->dbCommit('관리자 - 회비 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeUpdate(Request $request)
    {
        $this->transaction();

        try {
            $fee = Fee::findOrFail($request->sid);
            $fee->setByData($request);

            /**
             * tid가 없는 상태인데 넣으려할때 random값 넣기
             */
            if($request->payment_status == 'Y'){
                $random = substr(Str::uuid(), 0, 15);
                $fee->tid='admin'.$random;
            }else{
                $fee->tid = null;
                $fee->payment_date = null;
            }
            $fee->update();

            $this->dbCommit('관리자 - 회비 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeDelete(Request $request)
    {
        $this->transaction();

        try {
            $fee = Fee::findOrFail($request->sid);
            $fee->del='Y';
            $fee->deleted_at=date('Y-m-d H:i:s');
            $fee->update();

            $this->dbCommit('관리자 - 회비 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function changePaymentStatus(Request $request)
    {
        $this->transaction();

        try {
            $fee = Fee::withTrashed()->findOrFail($request->sid);
            $fee->payment_status = $request->value;
            if($request->value=='Y'){
                $random = substr(Str::uuid(), 0, 15);
                $fee->tid='admin'.$random;
                $fee->payment_date = date('Y-m-d H:i:s');
            }else{
                $fee->tid = null;
                $fee->payment_date = null;
            }
            $fee->update();

            $this->dbCommit('관리자 - 회비 납부상태 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeRenew(Request $request)
    {
        /**
         * 회비 관리에서 {당해연도}.12.01부터 회비 셋팅
         */
        $currentDate = date('Y-m-d'); // 서버 현재 날짜
        $compareDate = date('Y') . '-12-01'; // 당해연도 12월 1일

        if ( ($currentDate < $compareDate) && masterIp() === false) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '차기연도 연회비 세팅은 당해연도 12월 1일부터 가능합니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        }
        
        $renewalServices = (new \App\Services\Cron\FeeRenewalServices());
        $renewResult = $renewalServices->renewalService();

        if ($renewResult != 'suc') {
            return $renewResult;
        }

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '갱신 되었습니다.',
            'location' => $this->ajaxActionLocation('reload')
        ]);
    }
}
