<?php

namespace App\Services\Mypage;

use App\Models\User;
use App\Models\Fee;
use App\Services\AppServices;
use App\Services\MailRealSendServices;
use App\Services\CommonServices;
use App\Services\Auth\AuthServices;
use Illuminate\Http\Request;

/**
 * Class MypageServices
 * @package App\Services
 */
class FeeServices extends AppServices
{
    public function listService(Request $request)
    {
        $this->data['user'] = thisUser();
        $this->data['list'] = $this->data['user']->fees; // 전체 회비내역
        $this->data['lastFee'] = $this->data['user']->lastFee; // 가장 최근 회비
        $this->data['isLifeMember'] = $this->data['user']->isLifeMember(); // 종신회원 체크

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->feeConfig = getConfig('fee');
        $this->data['user'] = thisUser();

        $fee_sid_arr = explode(',',$request->sid);
        $fee_list = Fee::whereIn('sid', $fee_sid_arr)->get();

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

    public function transactionService(Request $request)
    {
        $this->data['user'] = thisUser();
        $fee_list = Fee::where([
            'tid' => $request->tid,
            'user_sid' => thisPK(),
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
        
        $this->data['user'] = thisUser();

        $fee_list = Fee::where([
            'tid' => $request->tid,
            'user_sid' => thisPK(),
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
            default:
                return notFoundRedirect();
        }
    }

    private function feeCreate(Request $request)
    {
        $this->transaction();

        try {
            $fee_sid_arr = explode(',',$request->sid);
            $fee_list = Fee::whereIn('sid', $fee_sid_arr)->get();

//            $fee = Fee::findOrFail($request->sid);

            foreach ($fee_list as $idx => $fee){
                
                //종신회비 납부일 경우, 종신회원으로 update
                if($request->category == 'C'/*종신회비*/){
                    $user = $fee->user;
                    $user->grade='B'/*종신회원*/;
                    $user->level='NB'/*종신회원*/;
                    $user->update();
                }

                // 카드결제,실시간 계좌이체일 경우 사전등록 완료메일 바로 발송 (무통장입금일경우 입금완료후 발송)
                if ($request->payment_method === 'Card' || $request->payment_method === 'DirectBank') {
                    $fee->resultCode = $request->resultCode; // 카드결제 결과 코드
                    $fee->resultMsg = $request->resultMsg; // 카드결제 결과 메세지
                    $fee->TotPrice = $request->TotPrice; // 카드결제 금액
                    $fee->MOID = $request->MOID; // 카드결제 주문번호
                    $fee->tid = $request->tid; // 카드결제 거래번호
                    $fee->payment_method = $request->payment_method;
                    $fee->payment_status = 'Y';
                    $fee->payment_date = date('Y-m-d H:i:s');
                    $fee->update(); // 카드결제 정보 저장

                    // 메일 한번만 발송
                    if($idx == 0){
                        $mailData = [
                            'receiver_name' => $fee->user->name_kr ?? '',
                            'receiver_email' => $fee->user->email ?? '',
                            'body' => view("template.fee-ok", [ 'fee'=>$fee])->render(),
                        ];

                        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'fee-ok');

                        if ($mailResult != 'suc') {
                            return $mailResult;
                        }
                        // END 메일 발송
                    }

                }else{
                    $fee->resultCode = $request->resultCode; // 카드결제 결과 코드
                    $fee->resultMsg = $request->resultMsg; // 카드결제 결과 메세지
                    $fee->TotPrice = $request->TotPrice; // 카드결제 금액
                    $fee->MOID = $request->MOID; // 카드결제 주문번호
                    $fee->tid = $request->tid; // 카드결제 거래번호
                    $fee->payment_method = $request->payment_method;
                    $fee->payment_status = 'N';
                    $fee->update();

                    // 메일 한번만 발송
                    if($idx == 0) {
                        $mailData = [
                            'receiver_name' => $fee->user->name_kr ?? '',
                            'receiver_email' => $fee->user->email ?? '',
                            'body' => view("template.fee-request", ['fee' => $fee])->render(),
                        ];

                        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'user-create');

                        if ($mailResult != 'suc') {
                            return $mailResult;
                        }
                        // END 메일 발송
                    }
                }

            }


            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 회비결제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '완료 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
