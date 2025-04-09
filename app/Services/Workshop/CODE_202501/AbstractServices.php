<?php

namespace App\Services\Workshop\CODE_202501;

use App\Models\Abs;
use App\Models\Affiliations;
use App\Models\Authors;
use App\Models\User;
use App\Models\Fee;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Country;
use App\Services\CommonServices;
use App\Services\AppServices;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class AbstractServices
 * @package App\Services
 */
class AbstractServices extends AppServices
{
    private $maxAddCnt = 20; // Affiliation or Author 최대 등록 갯수

    public function indexService(Request $request)
    {
        $work_code = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;
        $this->data['maxAddCnt'] = $this->maxAddCnt;

        $this->data['endDate'] = $this->transDate($workshop->abs_edate);
        $this->data['isAbsDue'] = now() < $workshop->abs_edate && now() > $workshop->abs_sdate;
        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        if(!empty($request->reg_sid)){
            $this->data['reg'] = Registration::withTrashed()->findOrFail($request->reg_sid);
            $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
        }
        if(!empty($request->sid)){
            $this->data['abs'] = Abs::withTrashed()->findOrFail($request->sid);
            $this->data['reg'] = Registration::findOrFail($this->data['abs']->reg_sid);
            $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
        }
        return $this->data;
    }

    public function registService(Request $request)
    {
        $work_code = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;
        $this->data['maxAddCnt'] = $this->maxAddCnt;

        $this->data['endDate'] = $this->transDate($workshop->abs_edate);

        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        if(!empty($request->reg_sid)){
            $this->data['reg'] = Registration::withTrashed()->findOrFail($request->reg_sid);
            $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
        }
        //초록등록 기간체크
        if(!empty($request->sid)){
            $this->data['abs'] = Abs::withTrashed()->findOrFail($request->sid);
            $this->data['reg'] = Registration::findOrFail($this->data['abs']->reg_sid);
            $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();
            if( now() >= $workshop->abs_edate ){
                if($workshop->abs_grace_yn == 'Y'){
                    $this->data['isAbsDue'] = now() <= $workshop->abs_grace_edate && now() >= $workshop->abs_grace_sdate;
                }else{
                    $this->data['isAbsDue'] = false;
                }
            }else{
                $this->data['isAbsDue'] = now() <= $workshop->abs_edate && now() >= $workshop->abs_sdate;
            }
        }else{
            $this->data['isAbsDue'] = now() < $workshop->abs_edate && now() > $workshop->abs_sdate;
        }
        return $this->data;
    }

    public function listService(Request $request)
    {
        $work_code = $request->work_code;
        $workshop = Workshop::where(['del'=>'N', 'work_code'=>$work_code])->first();
        $this->data['workshop'] = $workshop;
        $this->data['endDate'] = $this->transDate($workshop->abs_edate);
        $this->data['isAbsDue'] = now() < $workshop->abs_edate && now() > $workshop->abs_sdate;

        if(!empty($request->reg_sid)){
            $this->data['reg'] = Registration::withTrashed()->findOrFail($request->reg_sid);
            $this->data['abs_list'] = Abs::withTrashed()->where(['reg_sid'=>$request->reg_sid])->orderByDesc('sid')->get();
            if( now() >= $workshop->abs_edate ){
                if($workshop->abs_grace_yn == 'Y'){
                    $this->data['isAbsGraceDue'] = now() <= $workshop->abs_grace_edate && now() >= $workshop->abs_grace_sdate;
                }else{
                    $this->data['isAbsGraceDue'] = false;
                }
            }else{
                $this->data['isAbsGraceDue'] = false;
            }
        }

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'abstract-check':
                return $this->abstractCheckServices($request);
            case 'abstract-create':
                return $this->abstractCreateServices($request);
            case 'abstract-update':
                return $this->abstractUpdateServices($request);
            case 'abstract-delete':
                return $this->abstractDeleteServices($request);
            case 'abstract-complete':
                return $this->abstractCompleteServices($request);
            case 'abstract-search':
                return $this->abstractSearchServices($request);
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

    private function abstractCheckServices(Request $request)
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

            /**
             * 사전등록 참가 구분중 참석자의 경우 초록접수 불가
             * 사전등록 입금한 사용자만 접수가능
             */
            if ($reg->gubun == 'A'/*참석자*/) {
                return $this->returnJsonData('alert', [
                    'msg' => '초록접수 대상자가 아닙니다.',
                ]);
            }
            if ($reg->payment_status == 'N'/*사전등록 입금*/) {
                return $this->returnJsonData('alert', [
                    'msg' => '초록접수 대상자가 아닙니다.',
                ]);
            }

            /**
             * 초록등록 기간 체크
             */

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('abstract',['work_code'=>$reg->work_code, 'reg_sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function abstractCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $abs = new Abs();

            $workshop = Workshop::where(['del'=>'N', 'work_code'=>$request->work_code])->first();
            $request->merge(['workshop_sid'=>$workshop->sid]);

            $work_code_prefix = $request->work_code . '_A';

            $maxRegnum = Abs::withTrashed()->where('workshop_sid', $workshop->sid)
                ->where('regnum', 'LIKE', "{$work_code_prefix}%")
                ->max(\DB::raw("CAST(SUBSTRING(regnum, LENGTH('$work_code_prefix') + 1) AS UNSIGNED)"));

            $nextNumber = ($maxRegnum ?? 0) + 1;
            $regnum = $work_code_prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // 생성된 regnum을 request에 추가
            $request->merge(['regnum' => $regnum]);

            $abs->setByData($request);
            $abs->save(); // created_at만 생성됨

            $this->affiDeleteRestore($request, $abs->sid);

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 초록등록 생성');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('abstract.preview',['work_code'=>$request->work_code,'sid'=>$abs->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function abstractUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $abs = Abs::findOrFail($request->sid);
            $abs->setByData($request);
            $abs->update();

            $this->affiDeleteRestore($request, $abs->sid);

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 초록등록 수정');

            //complete한 상태에서 수정인 경우
            if($abs->status == 'Y'){
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('abstract.search',['work_code'=>$request->work_code]) ));
            }

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('abstract.preview',['work_code'=>$request->work_code,'sid'=>$abs->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function abstractDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $abs = Abs::findOrFail($request->sid);
            $abs->del='Y';
            $abs->deleted_at=date('Y-m-d H:i:s');
            $abs->timestamps = false; // updated_at 자동 생성 비활성화
            $abs->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 초록등록 삭제');


            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function abstractCompleteServices(Request $request)
    {
        $this->transaction();

        try {
            $abs = Abs::findOrFail($request->sid);
            $abs->status = 'Y';
            $abs->complete_at = date('Y-m-d H:i:s');
            $abs->timestamps = false; // updated_at 자동 갱신 비활성화
            $abs->update();

            $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];
            $reg_country = Country::where(['cc'=>$abs->registration->country])->first();

            // 메일 한번만 발송
            $mailData = [
                'receiver_name' => $abs->registration->name_kr ?? '',
                'receiver_email' => $abs->registration->email ?? '',
                'body' => view("template.abstract-ok", [ 'abs'=>$abs, 'workshopConfig' =>$this->workshopConfig, 'mail_country'=>$reg_country->cn ])->render(),
            ];

            $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'abstract-ok',['subject'=>"[대한환경공학회] ".$abs->workshop->subject." 초록접수 완료 안내 드립니다."]);

            if ($mailResult != 'suc') {
                return $mailResult;
            }
            // END 메일 발송

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 초록등록 완료');


            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('abstract.complete',['work_code'=>$request->work_code,'sid'=>$abs->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function abstractSearchServices(Request $request)
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

            /**
             * 사전등록 참가 구분중 참석자의 경우 초록접수 불가
             * 사전등록 입금한 사용자만 접수가능
             */
            if ($reg->gubun == 'A'/*참석자*/) {
                return $this->returnJsonData('alert', [
                    'msg' => '초록접수 대상자가 아닙니다.',
                ]);
            }
            if ($reg->payment_status == 'N'/*사전등록 입금*/) {
                return $this->returnJsonData('alert', [
                    'msg' => '초록접수 대상자가 아닙니다.',
                ]);
            }

            /**
             * 초록
             */
            $abs = Abs::withTrashed()->where(['reg_sid'=>$reg->sid])->first();
            if (empty($abs)) {
                return $this->returnJsonData('alert', [
                    'msg' => '등록한 초록 정보가 없습니다.',
                ]);
            }
            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('abstract.list',['work_code'=>$reg->work_code, 'reg_sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function affiDeleteRestore(Request $request, $abs_sid){
// ====================================== affiliation (affiliation 등록 및 수정) ================================================================================
        // Affiliation 제거
        if( isset($abs_sid) ){
            Affiliations::where('abs_sid', $abs_sid)->forceDelete();

            foreach ($request->affiliation_ord ?? [] as $key => $val) {
                $setData = [
                    'abs_sid' => $abs_sid,
                    'affi_kr' => $request->affi_kr[$key] ?? null,
                    'affi_en' => $request->affi_en[$key] ?? null,
                ];

                $abstractAffiliation = new Affiliations();
                $abstractAffiliation->setByData($setData);
                $abstractAffiliation->save();
            }
        }
// ====================================== //affiliation (affiliation 등록 및 수정) ===============================================================================

// ====================================== author (author 등록 및 수정) ================================================================================
        // Author 삭제
        if( isset($abs_sid) ) {
            Authors::where('abs_sid', $abs_sid)->forceDelete();

            foreach ($request->author_ord ?? [] as $key => $val) {
                $eq = $val;

                $setData = [
                    'abs_sid' => $abs_sid,
                    'c_author_yn' => ($request->input("c_author_yn_{$eq}") == 'Y' ?? 'N'),
                    'name_kr' => $request->name_kr[$key],
                    'first_name' => $request->first_name[$key],
                    'last_name' => $request->last_name[$key],
                    'affiliation' => $request->input("affiliation_check_{$eq}"),
                ];

                $abstractAuthor = new Authors();
                $abstractAuthor->setByData($setData);
                $abstractAuthor->save();
            }
        }
// ====================================== //author (author 등록 및 수정) ===============================================================================
    }
    private function addAffiliationServices(Request $request)
    {
        $this->data['eq'] = $request->eq;

        return $this->returnJsonData('after', [
            $this->ajaxActionHtml('.target-affiliation:last', view('workshop.'.$request->work_code.'.'.'abstract.include.affiliation', $this->data)->render()),
        ]);
    }

    private function addAuthorServices(Request $request)
    {
        $this->data['eq'] = $request->eq;
        $this->data['maxAddCnt'] = $this->maxAddCnt;
        $this->data['affiliations_count'] = $request->affiliations_count;

//        for ($i = 1; $i <= $request->set; $i++) {
//            $html[] = $this->ajaxActionHtml('.target-author:last', view('workshop.'.$request->work_code.'.'.'abstract.include.author', $this->data)->render());
//            $this->data['eq']++;
//        }

        return $this->returnJsonData('after', [
            $this->ajaxActionHtml('.target-author:last', view('workshop.'.$request->work_code.'.'.'abstract.include.author', $this->data)->render()),
        ]);
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
