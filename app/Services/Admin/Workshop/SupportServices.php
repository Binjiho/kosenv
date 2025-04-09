<?php

namespace App\Services\Admin\Workshop;

use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Exports\SupportExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use App\Models\Workshop;
use App\Models\Support;
use Illuminate\Http\Request;

/**
 * Class RegistrationServices
 * @package App\Services
 */
class SupportServices extends AppServices
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
            case 'elimination' :
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_후원신청삭제list';
                $query = Support::withTrashed()->where(['work_code'=>$request->work_code, 'del'=>'Y'])->orderByDesc('created_at');
                break;
            default:
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_후원신청list';
                $query = Support::withTrashed()->where(['work_code'=>$request->work_code, 'del'=>'N'])->orderByDesc('sid'); // 삭제 제외 전체
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

        if ($request->status) {
            $query->where('status', '=', $request->status);
        }

        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            return (new CommonServices())->excelDownload(new SupportExcel($this->data), $excelName);
        }


        $list = $query->paginate($li_page);
        $this->data['list'] = setListSeq($list);

        // 구분 카운트
        $this->data['gradeCnt'] = $query->get('grade')->groupBy('grade')
            ->map(function ($group) {
                return $group->count();
            });
        // 결제방법 카운트
        $this->data['spay_methodCnt'] = $query->get('spay_method')->groupBy('spay_method')
            ->map(function ($group) {
                return $group->count();
            });
        // 결제상태 카운트
        $this->data['spayment_statusCnt'] = $query->get('spayment_status')->groupBy('spayment_status')
            ->map(function ($group) {
                return $group->count();
            });
        // 전체 카운트
        $this->data['total_cnt'] = $query->count();

        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['work_code'] = $request->work_code;
        $this->data['sup'] = Support::withTrashed()->findOrFail($request->sid);

        return $this->data;
    }

    public function popupService(Request $request)
    {
        $this->data['work_code'] = $request->work_code;
        $this->data['sup'] = Support::withTrashed()->findOrFail($request->sid);
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'support-update':
                return $this->supportUpdate($request);
            case 'support-delete':
                return $this->supportDelete($request);
            case 'support-restore':
                return $this->supportRestore($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'resend-mail':
                return $this->resendMail($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function supportUpdate(Request $request)
    {
        $this->transaction();

        try {
            $sup = Support::withTrashed()->findOrFail($request->sid);

            $sup->setBydata($request);
            $sup->timestamps = false; // updated_at 자동 업데이트 방지
            $sup->update();

            $this->dbCommit('관리자 - 후원신청 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function supportDelete(Request $request)
    {
        $this->transaction();

        try {
            $sup = Support::withTrashed()->findOrFail($request->sid);
            $sup->del='Y';
            $sup->deleted_at=date('Y-m-d H:i:s');

            $sup->timestamps = false; // updated_at 자동 업데이트 방지
            $sup->update();

            $this->dbCommit('관리자 - 후원신청 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
    private function supportRestore(Request $request)
    {
        $this->transaction();

        try {
            $sup = Support::withTrashed()->findOrFail($request->sid);
            $sup->del='N';
            $sup->deleted_at=null;

            $sup->timestamps = false; // updated_at 자동 업데이트 방지
            $sup->update();

            $this->dbCommit('관리자 - 후원신청 원복');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '원복 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function dbChangeServices(Request $request)
    {
        $this->transaction();

        try {

            $field = $request->field;
            $value = $request->value;

            $sup = Support::withTrashed()->findOrFail($request->sid);
            $sup->{$field} = $value;

            if($field == 'spayment_status'){
                if($value == 'Y'){
                    $sup->payment_date = date('Y-m-d H:i:s');
                }else{
                    $sup->payment_date = null;
                }
            }

            if($field == 'status'){
                if($value == 'Y'){
                    $sup->complete_at = date('Y-m-d H:i:s');
                }else{
                    $sup->complete_at = null;
                }
            }
            $sup->timestamps = false; // updated_at 자동 업데이트 방지
            $sup->update();

            $this->dbCommit('관리자 - 후원신청 변경');

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
        $sup = Support::withTrashed()->findOrFail($request->sid);
        if(empty($request->email)){
            $email = $sup->email;
        }else{
            $email = $request->email;
        }


        $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];

        if($sup->spayment_status == 'N'){
            $template = 'support-bank';
            $subject = "[대한환경공학회] ".$sup->workshop->subject." 후원접수 신청 완료 안내 드립니다. (신청 비용 입금 요청)";
        }else{
            $template = 'support-ok';
            $subject = "[대한환경공학회] ".$sup->workshop->subject." 후원신청 완료 안내 드립니다.";
        }

        // 메일 한번만 발송
        $mailData = [
            'receiver_name' => $sup->manager ?? '',
            'receiver_email' => $email ?? '',
            'body' => view("template.".$template, [ 'sup'=>$sup, 'workshopConfig' =>$this->workshopConfig])->render(),
        ];

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, $template,['subject'=>$subject]);

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


}
