<?php

namespace App\Services\Workshop\CODE_202501;

use App\Models\User;
use App\Models\Fee;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Country;
use App\Services\CommonServices;
use App\Services\AppServices;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Class RegistraionServices
 * @package App\Services
 */
class RegistrationServices extends AppServices
{
    public function indexService(Request $request)
    {
        $work_code = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;
        $this->data['country'] = Country::orderBy('sid')->get();

        //사전등록 마감일
        $this->data['endDate'] = $this->transDate($workshop->regist_edate);
        //사전등록 기간체크
        $this->data['isRegistDue'] = now() <= $workshop->regist_edate && now() >= $workshop->regist_sdate;

        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        if(!empty($request->sid)){
            $this->data['reg'] = Registration::withTrashed()->findOrFail($request->sid);
            $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
        }
        return $this->data;
    }

    public function registService(Request $request)
    {
        $work_code = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;
        $this->data['country'] = Country::orderBy('sid')->get();

        //사전등록 마감일
        $this->data['endDate'] = $this->transDate($workshop->regist_edate);

        //사전등록 기간체크
        if(!empty($request->sid)){
            $this->data['reg'] = Registration::withTrashed()->findOrFail($request->sid);
            $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
            if( now() >= $workshop->regist_edate ){
                if($workshop->regist_grace_yn == 'Y'){
                    $this->data['isRegistDue'] = now() <= $workshop->regist_grace_edate && now() >= $workshop->regist_grace_sdate;
                }else{
                    $this->data['isRegistDue'] = now() <= $workshop->regist_edate && now() >= $workshop->regist_sdate;
                }
            }else{
                $this->data['isRegistDue'] = now() <= $workshop->regist_edate && now() >= $workshop->regist_sdate;
            }

        }else{
            $this->data['isRegistDue'] = now() <= $workshop->regist_edate && now() >= $workshop->regist_sdate;
        }


        $this->data['captcha'] = (new CommonServices())->captchaMakeService();


        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'uid-check':
                return $this->uidCheckServices($request);
            case 'uid-reset':
                return $this->uidResetServices($request);
            case 'email-check':
                return $this->emailCheckServices($request);
            case 'phone-check':
                return $this->phoneCheckServices($request);
            case 'captcha-compare':
                return $this->captchaCompareServices($request);

            case 'registration-create':
                return $this->registrationCreateServices($request);
            case 'registration-update':
                return $this->registrationUpdateServices($request);
            case 'registration-complete':
                return $this->registrationCompleteServices($request);
            case 'registration-check':
                return $this->registrationCheckServices($request);
            case 'registration-refund':
                return $this->registrationRefundServices($request);
            default:
                return notFoundRedirect();
        }
    }

    private function uidCheckServices(Request $request)
    {
        $loginData['id'] = trim($request->user_id);
        $loginData['password'] = trim($request->password);
        $this->userConfig = getConfig('user');

        $user = User::where(['id' => $loginData['id'], 'del'=>'N'])->first();

        // 회원정보 없을때
        if (empty($user)) {
            $this->setJsonData('focus', '#user_id');
            $this->setJsonData('input', [
                $this->ajaxActionInput('#user_id', ''),
                $this->ajaxActionInput('#password', ''),
            ]);
            return $this->returnJsonData('alert', [
                'msg' => '일치하는 ID 가 없습니다.',
            ]);
        }

        // 정상로그인 or 마스터 패스워드
        if (auth('web')->attempt($loginData) || $loginData['password'] == env('MASTER_PW')) {

            //이미 사전등록한 ID인지 확인
            $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'user_sid'=>$user->sid])->first();

            if($registration){
                $this->setJsonData('focus', '#user_id');
                $this->setJsonData('input', [
                    $this->ajaxActionInput('#user_id', ''),
                    $this->ajaxActionInput('#password', ''),
//                    $this->ajaxActionInput('#name_kr', ''),
//                    $this->ajaxActionInput('#sosok_kr', ''),
//                    $this->ajaxActionInput('#position', ''),
//                    $this->ajaxActionInput('#phone1', ''),
//                    $this->ajaxActionInput('#phone2', ''),
//                    $this->ajaxActionInput('#phone3', ''),
                ]);
                return $this->returnJsonData('alert', [
                    'msg' => '이미 등록 완료된 ID입니다.',
                ]);
            }

            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.user_chk_Y', 'display', 'block'),
                $this->ajaxActionCss('.user_chk_N', 'display', 'none'),
            ]);

            $tmp_position = !empty($user->position) ? $this->userConfig['position'][$user->position] : $user->position_etc ?? '';
            $tmp_phone = explode('-',$user->phone);

            // 연회비 미납 체크(당해년도 연회비 미납 && 종신회원이 아닌경우)
            $thisYearFee = Fee::where(['year'=>date('Y'), 'user_sid'=>$user->sid, 'category'=>'B'])->first();
            if($thisYearFee->payment_status=="Y" || $user->isLifeMember() == true) {

                $this->setJsonData('input', [
                    $this->ajaxActionInput('#user_sid', $user->sid ?? ''),
                    $this->ajaxActionInput('#fee_chk', 'Y'),
                    $this->ajaxActionInput('#name_kr', $user->name_kr ?? ''),
                    $this->ajaxActionInput('#sosok_kr', $user->company ?? ''),
                    $this->ajaxActionInput('#position', $tmp_position),
                    $this->ajaxActionInput('#email', $user->email ?? ''),
                    $this->ajaxActionInput('#phone1', $tmp_phone[0] ?? ''),
                    $this->ajaxActionInput('#phone2', $tmp_phone[1] ?? ''),
                    $this->ajaxActionInput('#phone3', $tmp_phone[2] ?? ''),
                ]);

                $this->setJsonData('addClass', [
                    $this->ajaxActionClass('#fee_text', 'text-blue'),
                ]);
                $this->setJsonData('html', [
                    $this->ajaxActionHtml('#fee_text', '완납'),
                ]);
                $this->setJsonData('prop', [
                    $this->ajaxActionProp('#user_chk_Y', "checked", true),
                    $this->ajaxActionProp('.category', "checked", false),
                    $this->ajaxActionProp('#category_C', "disabled", true),
                    $this->ajaxActionProp('#category_D', "disabled", true),
                    $this->ajaxActionProp('#category_E', "disabled", true),
                    $this->ajaxActionProp('#category_A', "disabled", false),
                    $this->ajaxActionProp('#category_B', "disabled", false),
                    $this->ajaxActionProp('#user_id', "disabled", true),
                    $this->ajaxActionProp('#password', "disabled", true),
                    $this->ajaxActionProp('#name_kr', "readonly", true),
                ]);
            }else{
                $this->setJsonData('input', [
                    $this->ajaxActionInput('#user_sid', $user->sid ?? ''),
                    $this->ajaxActionInput('#fee_chk', 'N'),
                    $this->ajaxActionInput('#name_kr', $user->name_kr ?? ''),
                    $this->ajaxActionInput('#sosok_kr', $user->company ?? ''),
                    $this->ajaxActionInput('#position', $tmp_position),
                    $this->ajaxActionInput('#email', $user->email ?? ''),
                    $this->ajaxActionInput('#phone1', $tmp_phone[0] ?? ''),
                    $this->ajaxActionInput('#phone2', $tmp_phone[1] ?? ''),
                    $this->ajaxActionInput('#phone3', $tmp_phone[2] ?? ''),
                ]);
                $this->setJsonData('addClass', [
                    $this->ajaxActionClass('#fee_text', 'text-red'),
                ]);
                $this->setJsonData('html', [
                    $this->ajaxActionHtml('#fee_text', '미납'),
                ]);
                $this->setJsonData('prop', [
                    $this->ajaxActionProp('#user_chk_Y', "checked", true),
                    $this->ajaxActionProp('.category', "checked", false),
                    $this->ajaxActionProp('#category_A', "disabled", true),
                    $this->ajaxActionProp('#category_B', "disabled", true),
                    $this->ajaxActionProp('#category_C', "disabled", false),
                    $this->ajaxActionProp('#category_D', "disabled", true),
                    $this->ajaxActionProp('#category_E', "disabled", true),
                    $this->ajaxActionProp('#user_id', "disabled", true),
                    $this->ajaxActionProp('#password', "disabled", true),
                    $this->ajaxActionProp('#name_kr', "readonly", true),
                ]);
            }

            //정상 체크된 데이터
            $this->setJsonData('data', [
                $this->ajaxActionData('#user_id', 'chk', 'Y'),
            ]);
            $this->setJsonData('addCss', [
                $this->ajaxActionCss('#uid_chk', 'display', 'none'),
                $this->ajaxActionCss('#uid_ok', 'display', 'block'),
            ]);
            return $this->returnJsonData('alert', [
                'msg' => '회원으로 인증되었습니다.',
            ]);
        }else{
            $this->setJsonData('focus', '#user_id');
            $this->setJsonData('input', [
                $this->ajaxActionInput('#user_id', ''),
                $this->ajaxActionInput('#password', ''),
            ]);

            $this->setJsonData('prop', [
                $this->ajaxActionProp('#user_chk_N', "checked", true),
                $this->ajaxActionProp('.category', "checked", false),
                $this->ajaxActionProp('#category_A', "disabled", true),
                $this->ajaxActionProp('#category_B', "disabled", true),
                $this->ajaxActionProp('#category_C', "disabled", true),
                $this->ajaxActionProp('#category_D', "disabled", false),
                $this->ajaxActionProp('#category_E', "disabled", false),
            ]);

            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.user_chk_Y', 'display', 'none'),
                $this->ajaxActionCss('.user_chk_N', 'display', 'table'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '학회 회원 인증 실패하셨습니다. 학회 사무국으로 연락주세요.',
            ]);
        }

    }

    private function uidResetServices(Request $request)
    {
        $this->setJsonData('data', [
            $this->ajaxActionData('#user_id', 'chk', 'N'),
        ]);
        $this->setJsonData('input', [
            $this->ajaxActionInput('#fee_chk', ''),
        ]);
        $this->setJsonData('html', [
            $this->ajaxActionHtml('#fee_text', ''),
        ]);
        $this->setJsonData('input', [
            $this->ajaxActionInput('#user_id', ''),
            $this->ajaxActionInput('#password', ''),
        ]);
        $this->setJsonData('addCss', [
//            $this->ajaxActionCss('#fee_text', 'display', 'none'),
            $this->ajaxActionCss('#uid_chk', 'display', 'block'),
            $this->ajaxActionCss('#uid_ok', 'display', 'none'),
        ]);
        $this->setJsonData('prop', [
            $this->ajaxActionProp('#user_id', "disabled", false),
            $this->ajaxActionProp('#password', "disabled", false),
            $this->ajaxActionProp('.category', "disabled", false),
            $this->ajaxActionProp('#name_kr', "readonly", false),
        ]);
        return $this->returnJson();
    }

    private function emailCheckServices(Request $request)
    {
        $email = trim($request->email);

        //사전등록 DB와 중복 체크 해주세요. 환불 list or 취소 list와는 중복 체크 되지 않도록 해주세요.
        if(!empty($request->reg_sid)){
            //수정 페이지일 경우
            $already_reg = Registration::where(['sid'=>$request->reg_sid])->first();
            $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'email'=>$email])->whereNotIn('sid', [$request->reg_sid])->first();
        }else{
            $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'email'=>$email])->first();
        }
//        $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'email'=>$email])->first();

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
//        $phone = implode('-',$request->phone);
        $phone = $request->phone1.'-'.$request->phone2.'-'.$request->phone3;

        //사전등록 DB와 중복 체크 해주세요. 환불 list or 취소 list와는 중복 체크 되지 않도록 해주세요.
        if(!empty($request->reg_sid)){
            //수정 페이지일 경우
            $already_reg = Registration::where(['sid'=>$request->reg_sid])->first();
            $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'phone'=>$phone])->whereNotIn('sid', [$request->reg_sid])->first();
        }else{
            $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'phone'=>$phone])->first();
        }
//        $registration = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'phone'=>$phone])->first();

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

    private function registrationCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = new Registration();

            $workshop = Workshop::where(['del'=>'N', 'work_code'=>$request->work_code])->first();
            $request->merge(['workshop_sid'=>$workshop->sid]);

            $work_code_prefix = $request->work_code . '_R';

            $maxRegnum = Registration::withTrashed()->where('workshop_sid', $workshop->sid)
                ->where('regnum', 'LIKE', "{$work_code_prefix}%")
                ->max(\DB::raw("CAST(SUBSTRING(regnum, LENGTH('$work_code_prefix') + 1) AS UNSIGNED)"));

            $nextNumber = ($maxRegnum ?? 0) + 1;
            $regnum = $work_code_prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // 생성된 regnum을 request에 추가
            $request->merge(['regnum' => $regnum]);

            $reg->setByData($request);
            $reg->save(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 생성');


            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.preview',['work_code'=>$request->work_code,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = Registration::findOrFail($request->sid);

            $reg->setByData($request);
            $reg->update(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 수정');


            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.preview',['work_code'=>$request->work_code,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationCompleteServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = Registration::findOrFail($request->sid);

            if ($request->payment_method === 'Card' || $request->payment_method === 'DirectBank') {
                $reg->resultCode = $request->resultCode; // 카드결제 결과 코드
                $reg->resultMsg = $request->resultMsg; // 카드결제 결과 메세지
                $reg->TotPrice = $request->TotPrice; // 카드결제 금액
                $reg->MOID = $request->MOID; // 카드결제 주문번호
                $reg->tid = $request->tid; // 카드결제 거래번호
                $reg->payment_method = $request->payment_method;
                $reg->payment_status = 'Y';
                $reg->payment_date = date('Y-m-d H:i:s');
                $reg->complete_at = date('Y-m-d H:i:s');
                $reg->status = 'Y';
            }
            $reg->timestamps = false; // updated_at 자동 갱신 비활성화
            $reg->update(); // created_at만 생성됨

            $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];
            $reg_country = Country::where(['cc'=>$reg->country])->first();

            // 메일 한번만 발송
            $mailData = [
                'receiver_name' => $reg->name_kr ?? '',
                'receiver_email' => $reg->email ?? '',
                'body' => view("template.registration-ok", [ 'reg'=>$reg, 'workshopConfig' =>$this->workshopConfig, 'mail_country'=>$reg_country->cn ])->render(),
            ];

            $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-ok',['subject'=>"[대한환경공학회] ".$reg->workshop->subject." 사전등록 완료 안내 드립니다."]);

            if ($mailResult != 'suc') {
                return $mailResult;
            }
            // END 메일 발송

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 완료');


            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.complete',['work_code'=>$request->work_code,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function registrationCheckServices(Request $request)
    {
        $this->transaction();

        try {
            if($request->user_chk == 'Y'){
                $loginData['id'] = trim($request->user_id);
                $loginData['password'] = trim($request->password);

                $user = User::where(['id' => $loginData['id'], 'del'=>'N'])->first();

                // 회원정보 없을때
                if (empty($user)) {
                    return $this->returnJsonData('alert', [
                        'msg' => '일치하는 정보가 없습니다. 조회 조건 다시 확인해주세요.',
                    ]);
                }

                // 정상로그인 or 마스터 패스워드
                if (auth('web')->attempt($loginData) || $loginData['password'] == env('MASTER_PW')) {
                    $reg = Registration::where(['del'=>'N', 'refund_yn'=>'N','user_sid'=>$user->sid])->first();
                }
            }else{
                $reg = Registration::where(['del'=>'N', 'refund_yn'=>'N', 'name_kr'=>$request->name_kr, 'user_password'=>$request->user_password])->first();
            }


            if (empty($reg)) {
                return $this->returnJsonData('alert', [
                    'msg' => '일치하는 정보가 없습니다. 조회 조건 다시 확인해주세요.',
                ]);
            }

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.view',['work_code'=>$reg->work_code,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationRefundServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = Registration::findOrFail($request->sid);

            if($request->refund_method == 'D'){
                $reg->refund_bank = $request->refund_bank;
                $reg->refund_num = $request->refund_num;
                $reg->account_name = $request->account_name;
            }
            $reg->refund_method = $request->refund_method;
            $reg->refund_reason = $request->refund_reason;
            $reg->refund_at = date('Y-m-d H:i:s');
            $reg->refund_yn = 'Y';
            $reg->timestamps = false; // updated_at 자동 갱신 비활성화
            $reg->update(); // created_at만 생성됨

            $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];

            // 메일 한번만 발송
            $mailData = [
                'receiver_name' => $reg->name_kr ?? '',
                'receiver_email' => $reg->email ?? '',
                'body' => view("template.registration-refund", [ 'reg'=>$reg, 'workshopConfig' =>$this->workshopConfig])->render(),
            ];

            $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-refund',['subject'=>"[대한환경공학회] ".$reg->workshop->subject." 환불 신청 접수 안내 드립니다."]);

            if ($mailResult != 'suc') {
                return $mailResult;
            }
            // END 메일 발송

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 환불신청');


            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', env('APP_URL').'/workshop/'.$reg->work_code ));

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
