<?php

namespace App\Services\Admin\Mail;

use App\Models\MailAddress;
use App\Models\MailAddressDetail;
use App\Models\MailList;
use App\Models\MailSend;
use App\Models\MailFile;
use App\Models\User;
use App\Models\WiseUMailLog;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class MailServices
 * @package App\Services
 */
class MailServices extends AppServices
{
    private $mailConfig;

    public function __construct()
    {
        $this->mailConfig = getConfig('mail');
    }

    public function indexService(Request $request)
    {
        $li_page = $request->li_page ?? 20;

        $query = MailList::orderByDesc('created_at');

        if ($request->subject) {
            $query->where('subject', 'LIKE', "%{$request->subject}%");
        }

        if ($request->sender_name) {
            $query->where('sender_name', 'LIKE', "%{$request->sender_name}%");
        }

        if ($request->create_sdate) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d')", '>=', $request->create_sdate);
        }

        if ($request->create_edate) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d')", '<=', $request->create_edate);
        }

        if ($request->send_sdate) {
            $query->whereRaw("DATE_FORMAT(send_date, '%Y-%m-%d')", '>=', $request->send_sdate);
        }

        if ($request->send_edate) {
            $query->whereRaw("DATE_FORMAT(send_date, '%Y-%m-%d')", '<=', $request->send_edate);
        }

        $list = $query->paginate(20);
        $this->data['list'] = setListSeq($list);
        $this->data['li_page'] = $li_page;

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid;
        $this->data['mail'] = empty($sid) ? null : MailList::findOrFail($sid);
        $this->data['address'] = MailAddress::all();

        return $this->data;
    }

    public function detailService(Request $request)
    {
        $ml_sid = $request->sid;

        $list = MailSend::where('ml_sid', $ml_sid)->orderByDesc('created_at')->paginate(20);

        $this->data['list'] = setListSeq($list);
        $this->data['mail'] = MailList::findOrFail($ml_sid);

        return $this->data;
    }

    public function previewService(Request $request)
    {
        $this->data['mail'] = MailList::findOrFail($request->sid);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'mail-create':
                return $this->mailCreateService($request);

            case 'mail-update':
                return $this->mailUpdateService($request);

            case 'mail-delete':
                return $this->mailDeleteService($request);

            case 'mail-upsert-preview': // 메일 작성중 미리보기
                return $this->mailUpsertPreviewService($request);

            case 'mail-send': // 메일 전체 발송 or 재발송
                return $this->mailSendService($request);

            case 'target-send': // 메일 특정대상 발송
                return $this->targetSendService($request);

            case 'send-renew': // 메일 발송 상태 갱신
                return $this->mailSendRenewService($request);

            default:
                return notFoundRedirect();
        }
    }

    private function mailCreateService(Request $request)
    {
        $this->transaction();

        try {
            $mail = (new MailList());
            $mail->setByData($request);
            $mail->save();

            // 메일 발송 일경우
            if ($request->send === 'Y') {
                $sendResult = $this->mailTypeSendService($mail);

                if ($sendResult !== 'suc') {
                    return $sendResult;
                }
            }

            $this->dbCommit('관리자 - 메일 등록 or 등록 및 발송');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailUpdateService(Request $request)
    {
        $this->transaction();

        try {
            $mail = MailList::findOrFail($request->sid);
            $mail->setByData($request);
            $mail->update();

            // 메일 발송 일경우
            if ($request->send === 'Y') {
                $sendResult = $this->mailTypeSendService($mail);

                if ($sendResult !== 'suc') {
                    return $sendResult;
                }
            }

            $this->dbCommit('관리자 - 메일 수정 or 수정 및 발송');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "수정 되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $mail = MailList::findOrFail($request->sid);
            $mail->delete();

            $this->dbCommit('관리자 - 메일 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "삭제 되었습니다.",
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function mailUpsertPreviewService(Request $request)
    {
        $template = $this->mailConfig['admin_template'][$request->template] ?? [];

        if (empty($template)) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '잘못된 접근 입니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        }

        $this->data['mail'] = (object)$request->all();
        $this->data['mail']->files = [];
        $this->data['preview'] = true;

        if ($request->sid != 0) {
            foreach (MailFile::where('ml_sid', $request->sid)->whereNotIn('sid', $request->plupload_file_del ?? [])->get() as $row) {
                $this->data['mail']->files[] = (object)['filename' => $row->filename];
            }
        }

        foreach ($request->plupload ?? [] as $key => $val) {
            $this->data['mail']->files[] = (object)['filename' => $val];
        }

        return $this->returnJsonData('html', view($template['path'], $this->data)->render());
    }

    // 메일 발송 or 재발송
    private function mailSendService(Request $request)
    {
        $this->transaction();

        try {
            $mail = MailList::findOrFail($request->sid);
            $mail->increment('thread');

            $sendResult = $this->mailTypeSendService($mail);

            if ($sendResult !== 'suc') {
                return $sendResult;
            }

            $sendType = ($mail->thread == 1 ? '발송' : '재발송');


            $this->dbCommit("관리자 {$mail->subject} 메일 {$sendType}");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "{$sendType} 되었습니다.",
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    // 발송 타입별 메일 발송
    private function mailTypeSendService($mail)
    {
        // 메일 발송
        $mailData = [];

        $additionalData = [
            'subject' => $mail->subject,
            'sender_name' => $mail->sender_name,
            'sender_email' => $mail->sender_email,
        ];

        $body = view($this->mailConfig['admin_template'][$mail->template]['path'], ['mail' => $mail, 'files' => $mail->files])->render();

        // 회원등급별 발송
        if ($mail->send_type == '1') {
            $user = User::whereIn('level', $mail->level)->where('email_yn', 'Y')->get();

            foreach ($user as $row) {
                $mailData[] = [
                    'ml_sid' => $mail->sid,
                    'receiver_name' => $row->getName(),
                    'receiver_email' => $row->email,
                    'body' => $body,
                ];
            }
        }

        // 주소록 발송
        if ($mail->send_type == '2') {
            $address = MailAddressDetail::where('ma_sid', $mail->ma_sid)->get();

            foreach ($address as $row) {
                $mailData[] = [
                    'ml_sid' => $mail->sid,
                    'receiver_name' => $row->getName(),
                    'receiver_email' => $row->email,
                    'body' => $body,
                ];
            }
        }

        // 테스트 전송
        if ($mail->send_type == '9') {
            $mailData[] = [
                'ml_sid' => $mail->sid,
                'receiver_name' => 'TEST 메일입니다',
                'receiver_email' => $mail->test_email,
                'body' => $body,
            ];
        }

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'admin-send', $additionalData);

        if ($mailResult != 'suc') {
            return $mailResult;
        }

        $this->transaction();

        try {
            // 대기 메일 업데이트
            $mail->update([
                'readyCnt' => $mail->readyMail()->count(),
                'failCnt' => $mail->failMail()->count(),
                'sucCnt' => $mail->sucMail()->count(),
            ]);

            $this->dbCommit("관리자 메일발송 대기 메일 업데이트");

            return 'suc';
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    // 지정대상 재발송 or 미발송메일 발송
    private function targetSendService(Request $request)
    {
        $mailSend = MailSend::findOrFail($request->sid);
        $mail = $mailSend->mail;

        $mailData[] = [
            'ml_sid' => $mail->sid,
            'receiver_name' => $mailSend->receiver_name,
            'receiver_email' => $mailSend->receiver_email,
            'body' => $mailSend->contents,
        ];

        $additionalData = [
            'subject' => $mail->subject,
            'sender_name' => $mail->sender_name,
            'sender_email' => $mail->sender_email,
        ];

        // 대기 메일 업데이트
        $mail->update([
            'readyCnt' => $mail->readyMail()->count(),
            'failCnt' => $mail->failMail()->count(),
            'sucCnt' => $mail->sucMail()->count(),
        ]);

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'admin-send', $additionalData);

        if ($mailResult != 'suc') {
            return $mailResult;
        }

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => "메일이 발송되었습니다.",
            'location' => $this->ajaxActionLocation('reload'),
        ]);
    }

    // 메일 발송상태 갱신
    private function mailSendRenewService(Request $request)
    {
        $mail = MailList::findOrFail($request->sid);
        $whereIn = $mail->totMail()->where('status', 'R')->pluck('wiseu_seq');

        if ($whereIn->isEmpty()) {
            return $this->returnJsonData('alert', [
                'msg' => "최신 상태입니다.",
            ]);
        }

        $wiseuLog = WiseUMailLog::where('ECARE_NO', $this->mailConfig['eCareNo'])->whereIn('CUSTOMER_KEY', $whereIn)->get();

        if ($wiseuLog->isEmpty()) {
            return $this->returnJsonData('alert', [
                'msg' => "메일 발송 로그 기록이 없습니다.",
            ]);
        }

        $this->transaction();

        try {
            foreach ($wiseuLog as $row) {
                $code = $row->ERROR_CD;

                if (!empty($this->mailConfig['code'][$code])) {
                    MailSend::where('wiseu_seq', $row->CUSTOMER_KEY)
                        ->update([
                            'status' => ($code === '250' || $code === '000') ? 'S' : 'F',
                            'status_msg' => $this->mailConfig['code'][$code],
                        ]);
                }
            }

            // 메일 발송상태 업데이트
            $mail->update([
                'readyCnt' => $mail->readyMail()->count(),
                'failCnt' => $mail->failMail()->count(),
                'sucCnt' => $mail->sucMail()->count(),
            ]);

            $this->dbCommit('관리자 - 메일 발송상태 갱신');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "갱신 되었습니다.",
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
