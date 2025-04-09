<?php

namespace App\Services\Workshop\CODE_202501;

use App\Models\Support;
use App\Models\User;
use App\Models\Workshop;
use App\Services\CommonServices;
use App\Services\AppServices;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class AbstractServices
 * @package App\Services
 */
class SupportServices extends AppServices
{
    public function indexService(Request $request)
    {
        $work_code = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;

        $this->data['endDate'] = $this->transDate($workshop->support_edate);
        $this->data['isSupportDue'] = now() < $workshop->support_edate && now() > $workshop->support_sdate;
        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        if(!empty($request->sid)){
            $this->data['sup'] = Support::withTrashed()->findOrFail($request->sid);
        }
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'support-create':
                return $this->supportCreateServices($request);
            case 'support-update':
                return $this->supportUpdateServices($request);
            case 'support-delete':
                return $this->supportDeleteServices($request);
            case 'support-complete':
                return $this->supportCompleteServices($request);
            case 'support-search':
                return $this->supportSearchServices($request);
            case 'captcha-compare':
                return $this->captchaCompareServices($request);
            case 'add-affiliation':
                return $this->addAffiliationServices($request);
            case 'add-author':
                return $this->addAuthorServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function supportCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $sup = new Support();

            $workshop = Workshop::where(['del'=>'N', 'work_code'=>$request->work_code])->first();
            $request->merge(['workshop_sid'=>$workshop->sid]);

            $work_code_prefix = $request->work_code . '_S';

            $maxRegnum = Support::withTrashed()->where('workshop_sid', $workshop->sid)
                ->where('regnum', 'LIKE', "{$work_code_prefix}%")
                ->max(\DB::raw("CAST(SUBSTRING(regnum, LENGTH('$work_code_prefix') + 1) AS UNSIGNED)"));

            $nextNumber = ($maxRegnum ?? 0) + 1;
            $regnum = $work_code_prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // 생성된 regnum을 request에 추가
            $request->merge(['regnum' => $regnum]);

            $sup->setByData($request);
            $sup->save(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 후원신청 생성');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('support.preview',['work_code'=>$request->work_code,'sid'=>$sup->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function supportUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $sup = Support::findOrFail($request->sid);
            $sup->setByData($request);
            $sup->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 후원신청 수정');

            //complete한 상태에서 수정인 경우
            if($sup->status == 'Y'){
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('support.search',['work_code'=>$request->work_code]) ));
            }

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('support.preview',['work_code'=>$request->work_code,'sid'=>$sup->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function supportDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $abs = Support::findOrFail($request->sid);
            $abs->del='Y';
            $abs->deleted_at=date('Y-m-d H:i:s');
            $abs->timestamps = false; // updated_at 자동 생성 비활성화
            $abs->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 후원신청 삭제');


            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function supportCompleteServices(Request $request)
    {
        $this->transaction();
        $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];

        try {
            $sup = Support::findOrFail($request->sid);
            $sup->status = 'Y';
            $sup->complete_at = date('Y-m-d H:i:s');
            $sup->spay_method = $request->spay_method;
            $sup->complete_at = date('Y-m-d H:i:s');

            if ($request->spay_method === 'Card' || $request->spay_method === 'DirectBank') {
                $sup->resultCode = $request->resultCode; // 카드결제 결과 코드
                $sup->resultMsg = $request->resultMsg; // 카드결제 결과 메세지
                $sup->TotPrice = $request->TotPrice; // 카드결제 금액
                $sup->MOID = $request->MOID; // 카드결제 주문번호
                $sup->tid = $request->tid; // 카드결제 거래번호

                $sup->spayment_status = 'Y';
                $sup->payment_date = date('Y-m-d H:i:s');

                $sup->timestamps = false; // updated_at 자동 갱신 비활성화
                $sup->update();

                // 메일 한번만 발송
                $mailData = [
                    'receiver_name' => $sup->manager ?? '',
                    'receiver_email' => $sup->email ?? '',
                    'body' => view("template.support-ok", [ 'sup'=>$sup, 'workshopConfig' =>$this->workshopConfig])->render(),
                ];
                $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'support-ok',['subject'=>"[대한환경공학회] ".$sup->workshop->subject." 후원접수 신청 및 결제 완료 안내 드립니다."]);

                if ($mailResult != 'suc') {
                    return $mailResult;
                }
                // END 메일 발송

            }else if($request->spay_method == 'Bank'){
                $sup->depositor = $request->depositor;
                $sup->deposit_date = $request->deposit_date;

                $sup->timestamps = false; // updated_at 자동 갱신 비활성화
                $sup->update();

                // 메일 한번만 발송
                $mailData = [
                    'receiver_name' => $sup->manager ?? '',
                    'receiver_email' => $sup->email ?? '',
                    'body' => view("template.support-ok", [ 'sup'=>$sup, 'workshopConfig' =>$this->workshopConfig])->render(),
                ];
                $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'support-bank',['subject'=>"[대한환경공학회] ".$sup->workshop->subject." 후원접수 신청 완료 안내 드립니다. (신청 비용 입금 요청)"]);

                if ($mailResult != 'suc') {
                    return $mailResult;
                }
                // END 메일 발송
            }


            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 후원신청 완료');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('support.complete',['work_code'=>$request->work_code,'sid'=>$sup->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function supportSearchServices(Request $request)
    {
        $this->transaction();
        try {
            $sup = Support::where(['company' => $request->company, 'manager' => $request->manager, 'email' => $request->email, 'del'=>'N'])->orderByDesc('sid')->first();

            // 회원정보 없을때
            if (empty($sup)) {
                return $this->returnJsonData('alert', [
                    'msg' => '일치하는 정보가 없습니다. 조회 조건 다시 확인해주세요.',
                ]);
            }

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('support.view',['work_code'=>$sup->work_code, 'sid'=>$sup->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


    private function transDate($date) {
        if(empty($date)){
            return '';
        }

        $carbonDate = Carbon::parse($date);

        // 요일 매핑 (0: 일요일, 1: 월요일, ..., 6: 토요일)
        $weekDays = ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'];

        $year = $carbonDate->format('Y');
        $month = $carbonDate->format('n'); // 앞에 0 없는 월
        $day = $carbonDate->format('j');   // 앞에 0 없는 일
        $weekDay = $weekDays[$carbonDate->format('w')]; // 한글 요일

        return "~<strong class=\"text-pink\">{$year}</strong>년 
            <strong class=\"text-pink\">{$month}</strong>월 
            <strong class=\"text-pink\">{$day}</strong>일 
            {$weekDay}";
    }

    private function captchaCompareServices(Request $request)
    {
        if($request->captcha_input === session('captcha')){
            $this->setJsonData('log', 'suc');

            $this->setJsonData('data', [
                $this->ajaxActionData('#captcha_input', 'chk', 'Y'),
                'log' => 'suc',
            ]);

            return $this->returnJson();
        }
        $this->setJsonData('data', [
            $this->ajaxActionData('#captcha_input', 'chk', 'N'),
            'log' => 'fail',
        ]);

        return $this->returnJson();
    }
}
