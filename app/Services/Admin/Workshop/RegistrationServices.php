<?php

namespace App\Services\Admin\Workshop;

use App\Exports\RegistrationExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Country;
use Illuminate\Http\Request;
/**
 * Class RegistrationServices
 * @package App\Services
 */
class RegistrationServices extends AppServices
{
    public function indexService(Request $request)
    {
        /**
         * config
         */
        $workshop = Workshop::where(['work_code'=>$request->work_code ])->first();
        $this->data['workshopConfig'] = getConfig("workshop")[$workshop->work_code] ?? [];


        $li_page = $request->li_page ?? 20;
        $this->data['li_page'] = $li_page;

        $listCase = $request->case ?? null;
        $this->data['listCase'] = empty($listCase) ? [] : ['case' => $listCase];


        switch ($listCase) {
            case 'refund' :
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_사전등록환불list';
                $query = Registration::withTrashed()->where(['work_code'=>$request->work_code, 'refund_yn'=>'Y', 'del'=>'N'])->orderByDesc('refund_at');
                break;
            case 'elimination' :
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_사전등록삭제list';
                $query = Registration::withTrashed()->where(['work_code'=>$request->work_code, 'del'=>'Y'])->orderByDesc('created_at');
                break;
            default:
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_사전등록list';
                $query = Registration::withTrashed()->where(['work_code'=>$request->work_code, 'del'=>'N', 'refund_yn'=>'N'])->orderByDesc('sid'); // 삭제 제외 전체
                break;
        }
        
        if ($request->regnum) {
            $query->where('regnum', 'like', "%{$request->regnum}%");
        }
        if ($request->name_kr) {
            $query->where('name_kr', 'like', "%{$request->name_kr}%");
        }
        if ($request->sosok_kr) {
            $query->where('sosok_kr', 'like', "%{$request->sosok_kr}%");
        }
        if ($request->email) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        if ($request->phone) {
            $tmpPhone = str_replace('-', '', $request->phone); // 입력값에서 '-' 제거
            $query->whereRaw("REPLACE(phone, '-', '') LIKE ?", ["%{$tmpPhone}%"]);
        }
        if ($request->gubun) {
            $query->where('gubun', '=', $request->gubun);
        }
        if ($request->category) {
            $query->where('category', '=', $request->category);
        }
        if ($request->shuttle_yn) {
            $query->where('shuttle_yn', '=', $request->shuttle_yn);
        }
        if ($request->payment_method) {
            $query->where('payment_method', '=', $request->payment_method);
        }
        if ($request->payment_status) {
            $query->where('payment_status', '=', $request->payment_status);
        }

        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            return (new CommonServices())->excelDownload(new RegistrationExcel($this->data), $excelName);
        }

        $list = $query->paginate($li_page);
        $this->data['list'] = setListSeq($list);

        // 참가구분별 카운트
        $this->data['gubunCnt'] = $query->get('gubun')->groupBy('gubun')
            ->map(function ($group) {
                return $group->count();
            });
        // 등록구분별 카운트
        $this->data['categoryCnt'] = $query->get('category')->groupBy('category')
            ->map(function ($group) {
                return $group->count();
            });
        // 셔틀버스 수요조사 카운트
        $this->data['shuttle_ynCnt'] = $query->get('shuttle_yn')->groupBy('shuttle_yn')
            ->map(function ($group) {
                return $group->count();
            });
        // 결제방법 카운트
        $this->data['payment_methodCnt'] = $query->get('payment_method')->groupBy('payment_method')
            ->map(function ($group) {
                return $group->count();
            });
        // 결제상태 카운트
        $this->data['payment_statusCnt'] = $query->get('payment_status')->groupBy('payment_status')
            ->map(function ($group) {
                return $group->count();
            });
        // 전체 카운트
        $this->data['total_cnt'] = $query->count();
        // 환불회원 카운트
//        $this->data['refund_cnt'] = $query->count();
        // 삭제회원 카운트
//        $this->data['elimination_cnt'] = $query->count();

        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['reg'] = Registration::findOrFail($request->sid);
        $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
        $this->data['mail_country'] = $this->data['reg_country']->cn;
        $this->data['work_code'] = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$request->work_code])->first();
        $this->data['workshop'] = $workshop;
        $this->data['country'] = Country::orderBy('sid')->get();

        return $this->data;
    }

    public function popupService(Request $request)
    {
        $this->data['reg'] = Registration::findOrFail($request->sid);
        $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
        $this->data['mail_country'] = $this->data['reg_country']->cn;
        $this->data['work_code'] = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$request->work_code])->first();
        $this->data['workshop'] = $workshop;
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'registration-update':
                return $this->registrationUpdate($request);
            case 'registration-delete':
                return $this->registrationDelete($request);
            case 'registration-restore':
                return $this->registrationRestore($request);
            case 'email-check':
                return $this->emailCheckServices($request);
            case 'phone-check':
                return $this->phoneCheckServices($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'resend-mail':
                return $this->resendMail($request);
            case 'memo-write':
                return $this->memoWrite($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function registrationUpdate(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::withTrashed()->findOrFail($request->sid);

            $registration->setBydata($request);
            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->del='Y';
            $registration->deleted_at=date('Y-m-d H:i:s');

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
    private function registrationRestore(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::withTrashed()->findOrFail($request->sid);
            $registration->del='N';
            $registration->deleted_at=null;

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 원복');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '원복 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function emailCheckServices(Request $request)
    {
        $email = trim($request->email);

        $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'email'=>$email])->whereNotIn('sid', [$request->reg_sid])->first();

        if (empty($registration)) {
            $this->setJsonData('data', [
                $this->ajaxActionData('#email', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 이메일 입니다.',
            ]);
        } else {
            $this->setJsonData('focus', '#email');

            return $this->returnJsonData('alert', [
                'msg' => '사용중인 이메일입니다. 다른 이메일을 입력해주세요.',
            ]);
        }
    }

    private function phoneCheckServices(Request $request)
    {
        $phone = $request->phone1.'-'.$request->phone2.'-'.$request->phone3;

        $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'phone'=>$phone])->whereNotIn('sid', [$request->reg_sid])->first();

        if (empty($registration)) {
            $this->setJsonData('data', [
                $this->ajaxActionData('#phone1', 'chk', 'Y'),
                $this->ajaxActionData('#phone2', 'chk', 'Y'),
                $this->ajaxActionData('#phone3', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 휴대폰번호 입니다.',
            ]);
        } else {
            return $this->returnJsonData('alert', [
                'msg' => '사용중인 휴대폰번호입니다. 다른 휴대폰번호를 입력해주세요.',
            ]);
        }
    }

    private function dbChangeServices(Request $request)
    {
        $this->transaction();

        try {

            $field = $request->field;
            $value = $request->value;

            $registration = Registration::withTrashed()->findOrFail($request->sid);
            $registration->{$field} = $value;

            if($field == 'payment_status'){
                if($value == 'Y'){
                    $registration->status = 'Y';
                    $registration->payment_date = date('Y-m-d H:i:s');
                    $registration->complete_at = date('Y-m-d H:i:s');
                }else if($value == 'N'){
                    $registration->status = 'N';
                    $registration->payment_date = null;
                    $registration->complete_at = null;
                }else if($value == 'R'){
                    $registration->refund_yn = 'Y';
                    $registration->refund_at = date('Y-m-d H:i:s');
                }else if($value == 'T'){
                    $registration->refund_complete_at = date('Y-m-d H:i:s');
                }
            }

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function resendMail(Request $request)
    {
        $reg = Registration::withTrashed()->findOrFail($request->sid);
        if(empty($request->email)){
            $email = $reg->email;
        }else{
            $email = $request->email;
        }

        $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];
        $reg_country = Country::where(['cc'=>$reg->country])->first();

        // 메일 한번만 발송
        $mailData = [
            'receiver_name' => $reg->name_kr ?? '',
            'receiver_email' => $email ?? '',
            'body' => view("template.registration-ok", [ 'reg'=>$reg, 'workshopConfig' =>$this->workshopConfig, 'mail_country'=>$reg_country->cn ])->render(),
        ];

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-ok',['subject'=>"[대한환경공학회] ".$reg->workshop->subject." 사전등록 완료 안내 드립니다."]);

        if ($mailResult != 'suc') {
            return $mailResult;
        }
        // END 메일 발송

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '발송 되었습니다.',
            'winClose' => $this->ajaxActionWinClose(),
        ]);
    }
    private function memoWrite(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::withTrashed()->findOrFail($request->sid);
            $registration->admin_memo = $request->admin_memo;
            
            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 메모 작성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '저장 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
