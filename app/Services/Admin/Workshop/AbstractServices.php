<?php

namespace App\Services\Admin\Workshop;

use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Exports\AbstractExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Abs;
use App\Models\Affiliations;
use App\Models\Authors;
use App\Models\Country;
use Illuminate\Http\Request;

/**
 * Class RegistrationServices
 * @package App\Services
 */
class AbstractServices extends AppServices
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
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_초록등록삭제list';
                $query = Abs::withTrashed()->where(['work_code'=>$request->work_code, 'del'=>'Y'])->orderByDesc('created_at');
                break;
            default:
                $excelName = date('Y-m-d').'_'.$workshop->subject.'_초록등록list';
                $query = Abs::withTrashed()->where(['work_code'=>$request->work_code, 'del'=>'N'])->orderByDesc('sid'); // 삭제 제외 전체
                break;
        }

        if ($request->regnum) {
            $query->where('regnum', 'like', "%{$request->regnum}%");
        }
        if ($request->name_kr) {
            $query->whereHas('registration', function ($q) use ($request) {
                $q->where('name_kr', 'like', "%{$request->name_kr}%");
            });
        }
        if ($request->sosok_kr) {
            $query->where('sosok_kr', 'like', "%{$request->sosok_kr}%");
        }
        if ($request->email) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        //교신저자
        if ($request->author_kr) {
            $query->whereHas('authors', function ($q) use ($request) {
                $q->where('name_kr', 'like', "%{$request->author_kr}%");
            });
        }
        //소속
        if ($request->affi_kr) {
            $query->whereHas('affiliations', function ($q) use ($request) {
                $q->where('affi_kr', 'like', "%{$request->affi_kr}%");
            });
        }
        if ($request->topic) {
            $query->where('topic', '=', $request->topic);
        }
        if ($request->title_kr) {
            $query->where('title_kr', 'like', "%{$request->title_kr}%")
                ->orWhere('title_en', 'like', "%{$request->title_kr}%");
        }
        if ($request->status) {
            $query->where('status', '=', $request->status);
        }

        if ($request->sid) {
            $query->where('sid', '=', $request->sid);
        }

        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            return (new CommonServices())->excelDownload(new AbstractExcel($this->data), $excelName);
        }

        // 워드 다운로드 할때
        if ($request->word) {
            $phpWord = $this->makeWordFile($query);

            // 파일명을 설정하고 파일을 서버에 저장하지 않고 직접 다운로드하도록 설정
            $fileName = $workshop->subject.'_초록 list' . '.docx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);

            // 파일 작성
            $writer = IOFactory::createWriter($phpWord, 'Word2007');
            $writer->save($temp_file);

            // 파일 다운로드
            return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
        }

        // 워드 preview
        if ($request->wordPreview) {
            $phpWord = $this->makeWordFile($query);

            // Word 내용을 HTML로 변환
            $writer = IOFactory::createWriter($phpWord, 'HTML');

            ob_start();
            $writer->save('php://output');

            $this->data['word'] = ob_get_clean();

            return $this->data;
        }

        $list = $query->paginate($li_page);
        $this->data['list'] = setListSeq($list);

        // 대주제별 카운트
        $this->data['topicCnt'] = $query->get('topic')->groupBy('topic')
            ->map(function ($group) {
                return $group->count();
            });
        // 제출상태 카운트
        $this->data['statusCnt'] = $query->get('status')->groupBy('status')
            ->map(function ($group) {
                return $group->count();
            });
        // 전체 카운트
        $this->data['total_cnt'] = $query->count();

        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['maxAddCnt'] = 20;
        $this->data['work_code'] = $request->work_code;
        $this->data['abs'] = Abs::withTrashed()->findOrFail($request->sid);
        $this->data['reg'] = Registration::findOrFail($this->data['abs']->reg_sid);
        $this->data['reg_country'] = Country::where(['cc'=>$this->data['reg']->country])->first();

        return $this->data;
    }

    public function popupService(Request $request)
    {
        $this->data['abs'] = Abs::withTrashed()->findOrFail($request->sid);
        $reg_country = Country::where(['cc'=>$this->data['abs']->registration->country])->first();
        $this->data['mail_country'] = $reg_country->cn;
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'abstract-update':
                return $this->abstractUpdate($request);
            case 'abstract-delete':
                return $this->abstractDelete($request);
            case 'abstract-restore':
                return $this->abstractRestore($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'resend-mail':
                return $this->resendMail($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function abstractUpdate(Request $request)
    {
        $this->transaction();

        try {
            $abs = Abs::withTrashed()->findOrFail($request->sid);

            $abs->setBydata($request);
            $abs->timestamps = false; // updated_at 자동 업데이트 방지
            $abs->update();

            $this->affiDeleteRestore($request, $abs->sid);

            $this->dbCommit('관리자 - 초록등록 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
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

    private function abstractDelete(Request $request)
    {
        $this->transaction();

        try {
            $abs = Abs::withTrashed()->findOrFail($request->sid);
            $abs->del='Y';
            $abs->deleted_at=date('Y-m-d H:i:s');

            $abs->timestamps = false; // updated_at 자동 업데이트 방지
            $abs->update();

            $this->dbCommit('관리자 - 초록등록 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
    private function abstractRestore(Request $request)
    {
        $this->transaction();

        try {
            $abds = Abs::withTrashed()->findOrFail($request->sid);
            $abds->del='N';
            $abds->deleted_at=null;

            $abds->timestamps = false; // updated_at 자동 업데이트 방지
            $abds->update();

            $this->dbCommit('관리자 - 초록등록 원복');

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

            $abs = Abs::withTrashed()->findOrFail($request->sid);
            $abs->{$field} = $value;

            if($field == 'status'){
                if($value == 'Y'){
                    $abs->complete_at = date('Y-m-d H:i:s');
                }else{
                    $abs->complete_at = null;
                }
            }
            $abs->timestamps = false; // updated_at 자동 업데이트 방지
            $abs->update();

            $this->dbCommit('관리자 - 초록등록 변경');

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
        $abs = Abs::withTrashed()->findOrFail($request->sid);
        if(empty($request->email)){
            $email = $abs->registration->email;
        }else{
            $email = $request->email;
        }

        $this->workshopConfig = getConfig("workshop")[$request->work_code] ?? [];
        $reg_country = Country::where(['cc'=>$abs->registration->country])->first();

        // 메일 한번만 발송
        $mailData = [
            'receiver_name' => $abs->registration->name_kr ?? '',
            'receiver_email' => $email ?? '',
            'body' => view("template.abstract-ok", [ 'abs'=>$abs, 'workshopConfig' =>$this->workshopConfig, 'mail_country'=>$reg_country->cn ])->render(),
        ];

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'abstract-ok',['subject'=>"[대한환경공학회] ".$abs->workshop->subject." 초록등록 완료 안내 드립니다."]);

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

    private function makeWordFile($query)
    {
        // 새로운 PHPWord 객체 생성
        $phpWord = new PhpWord();
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];  // 허용되는 이미지 확장자 목록
        $pregReplace = '/<[^a-zA-Z_]/'; // XML 에러 발생해서 추가

        foreach ($query->lazy() as $row) {

            // 새로운 섹션 추가
            $section = $phpWord->addSection();

            \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true); // < 등의 태그 사용

            // 제목(국문)
            $section->addText(
                $row->title_kr,
                ['name' => 'Arial', 'size' => 20, 'bold' => true],
                ['alignment' => 'center']
            );
            // 제목(영문)
            $section->addText(
                $row->title_en,
                array('name' => 'Arial', 'size' => 20, 'bold' => true),
                array('alignment' => 'center')
            );

            // 저자 정보
            $textRun = $section->addTextRun(array('alignment' => 'center'));
            $authors = $row->authors()->get();
            //저자(국문)
            foreach ($authors as $index => $author) {
                // 텍스트 스타일
                $textStyle = array('name' => 'Arial', 'size' => 10);

                // 발표자 여부에 따라 밑줄과 굵게 스타일 추가
                if ($author->presenter_yn == 'Y') {
                    $textStyle['bold'] = true;
                    $textStyle['underline'] = 'single';
                }

                $textRun->addText($author->name_kr, $textStyle);

                if (!empty($author->affiliation)) {
                    $textRun->addText(' ');  // 이름과 위첨자 사이에 공백 추가
                    $textRun->addText(implode(' ', $author->affiliation ?? []), array('superScript' => true, 'name' => 'Arial', 'size' => 7));
                }

                if (count($authors) > ($index + 1)) {
                    $textRun->addText(' · ');  // 저자들 사이에 쉼표 추가
                }
            }

            //저자(영문)
            $textRun = $section->addTextRun(array('alignment' => 'center'));
            foreach ($authors as $index => $author) {
                // 텍스트 스타일
                $textStyle = array('name' => 'Arial', 'size' => 10);

                // 발표자 여부에 따라 밑줄과 굵게 스타일 추가
//                if ($author->presenter_yn == 'Y') {
//                    $textStyle['bold'] = true;
//                    $textStyle['underline'] = 'single';
//                }

                $textRun->addText($author->first_name.' '.$author->last_name, $textStyle);

                if (!empty($author->affiliation)) {
                    $textRun->addText(' ');  // 이름과 위첨자 사이에 공백 추가
                    $textRun->addText(implode(' ', $author->affiliation ?? []), array('superScript' => true, 'name' => 'Arial', 'size' => 7));
                }

                if (count($authors) > ($index + 1)) {
                    $textRun->addText(' · ');  // 저자들 사이에 쉼표 추가
                }
            }
            $section->addTextBreak(); // 줄바꿈

            // 소속 정보
            $textRun = $section->addTextRun(array('alignment' => 'center'));
            $affiliations = $row->affiliations()->get();
            foreach ($affiliations as $index => $affiliation) {
                // 위첨자 스타일 적용
                $textRun->addText(($index + 1), ['superScript' => true, 'name' => 'Arial', 'size' => 7]);

                // 소속명 추가 (보통 스타일)
                $textRun->addText($affiliation->affi_kr, ['name' => 'Arial', 'size' => 10]);

                if ($index < count($affiliations) - 1) {
                    $textRun->addText(' · '); // 마지막 항목이 아니라면 " · " 추가
                }
            }

            $textRun = $section->addTextRun(array('alignment' => 'center'));
            foreach ($affiliations as $index => $affiliation) {
                // 위첨자 스타일 적용
                $textRun->addText(($index + 1), ['superScript' => true, 'name' => 'Arial', 'size' => 7]);

                // 소속명 추가 (보통 스타일)
                $textRun->addText($affiliation->affi_en, ['name' => 'Arial', 'size' => 10]);

                if ($index < count($affiliations) - 1) {
                    $textRun->addText(' · '); // 마지막 항목이 아니라면 " · " 추가
                }
            }
            $section->addTextBreak(); // 줄바꿈

            // Abstract (초록)
            $section->addText(
                '초록 (Abstract)',
                array('name' => 'Arial', 'size' => 11, 'bold' => true),
                array('alignment' => 'left')
            );

            $contents = strip_tags($row->contents ?? ''); // 허용되는 태그 제외 나머지 태그 지우기
            $contents = preg_replace($pregReplace, '', $contents); // XML 에러 발생해서 추가

            $textRun = $section->addTextRun(['alignment' => 'left']); // 왼쪽 정렬 적용
            \PhpOffice\PhpWord\Shared\Html::addHtml($textRun, $contents, false, false);

            $section->addTextBreak(); // 줄바꿈

            // Keywords (주제어)
            $section->addText(
                '주제어 (Keywords)',
                array('name' => 'Arial', 'size' => 11, 'bold' => true),
                array('alignment' => 'left')
            );

            $section->addText(
                $row->keyword1.($row->keyword2 ? ', '.$row->keyword2 : '').($row->keyword3 ? ', '.$row->keyword3 : '').($row->keyword4 ? ', '.$row->keyword4 : '').($row->keyword5 ? ', '.$row->keyword5 : ''),
                array('name' => 'Arial', 'size' => 10),
                array('alignment' => 'left')
            );
            $section->addTextBreak(); // 줄바꿈

            //사사
            $section->addText(
                '사사 (Acknowledgment)',
                array('name' => 'Arial', 'size' => 11, 'bold' => true),
                array('alignment' => 'left')
            );
            $section->addText(
                $row->ack,
                array('name' => 'Arial', 'size' => 10),
                array('alignment' => 'left')
            );
        }

        // 파일 작성
        return $phpWord;
    }

}
