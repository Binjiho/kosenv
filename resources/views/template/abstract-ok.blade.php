<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>대한환경공학회 전문가그룹 학술대회</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0;">
<table style="width:100%; max-width:650px; margin:0 auto; padding:0; border:1px solid #e2e2e2; border-collapse:collapse; border-spacing:0; text-align:left; color:#444;
        font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px; font-weight:400; letter-spacing:-0.5px; word-break:keep-all; box-sizing:border-box; ">
    <tbody>
    <tr>
        <td style="padding:0;">
            <img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/mail_header.png" alt="" style="display:block; margin:0 auto;">
        </td>
    </tr>
    <tr>
        <td style="padding:20px 50px; font-size:25px; font-weight:bold; letter-spacing:-1px; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; ">
            대한환경공학회 {{ $abs->workshop->subject ?? '' }} <br>
            초록접수 완료 안내 드립니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px 30px; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
            {{ $abs->registration->name_kr ?? '' }} 회원님. 안녕하십니까? <br>
            {{ $abs->workshop->subject ?? '' }} 사전등록 초록 접수 완료 안내 메일 드립니다. <br>
            초록접수 마감일 전까지 수정 및 철회 가능합니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        접수번호
                    </th>
                    <td colspan="3" style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->regnum ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        참가구분
                    </th>
                    <td colspan="3" style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['gubun'][$abs->registration->gubun] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        대한환경공학회 홈페이지 회원여부
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ ($abs->registration->user_chk ?? '') == 'Y' ? '회원' : '비회원' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        국적
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $mail_country ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        성명
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->registration->name_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        직장명 (소속)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->registration->sosok_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        직위
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->registration->position ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        이메일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->registration->email ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        휴대폰번호
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->registration->phone ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="width:100%; margin-top:20px; border-collapse:collapse; border-spacing:0; font-family:'맑은 고딕',Arial,sans-serif; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        대주제
                    </th>
                    <td colspan="3" style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['topic'][$abs->topic] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        논문 제목 (국문)
                    </th>
                    <td colspan="3" style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->title_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        논문 제목 (영문)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->title_en ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        초록 (Abstract)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {!! $abs->contents ?? '' !!}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        주제어 (Keywords)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->keyword1 ?? '' }} {{ $abs->keyword2 ?? '' }} {{ $abs->keyword3 ?? '' }} {{ $abs->keyword4 ?? '' }} {{ $abs->keyword5 ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        사사 (Acknowledgment)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $abs->ack ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="width:100%; margin-top:20px; border-collapse:collapse; border-spacing:0; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:50px;">
                    <col style="width:50px;">
                    <col style="width:150px;">
                    <col style="width:300px;">
                </colgroup>
                <thead>
                <tr>
                    <th style="padding:10px; background-color:#f4f4f4; border:1px solid #e2e2e2; border-left:0; font-weight:400; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        번호
                    </th>
                    <th style="padding:10px; background-color:#f4f4f4; border:1px solid #e2e2e2; border-left:0; font-weight:400; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        교신저자
                    </th>
                    <th style="padding:10px; background-color:#f4f4f4; border:1px solid #e2e2e2; border-left:0; font-weight:400; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        이름
                    </th>
                    <th style="padding:10px; background-color:#f4f4f4; border:1px solid #e2e2e2; border-left:0; border-right:0; font-weight:400; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        기관 및 소속
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($abs->authors as $key => $row)
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $key+1 }}
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        <label><input type="checkbox" name="" disabled="" {{ ($row->c_author_yn ?? 'N') == 'Y' ? 'checked' : '' }}></label>
                    </td>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $row->name_kr ?? '' }}<br>
                        {{ $row->first_name ?? '' }} {{ $row->last_name ?? '' }}
                    </td>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        @foreach($row->affiliation as $idx => $val)
                            {{ $idx+1 }}. {{ $abs->affiliations[$idx]['affi_kr'] ?? '' }} / {{ $abs->affiliations[$idx]['affi_en'] ?? '' }}<br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:60px 0; text-align:center;">
            <a href="{{ env('APP_URL') }}/workshop/{{$abs->work_code}}/abstract/search" target="_blank"><img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/btn_mail_abstract.png" alt=""></a>
        </td>
    </tr>
    <tr>
        <td style="padding:0; background-color: #3e5d66;">
            <img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/mail_footer.png" alt="" style="display:block; margin:0 auto;">
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>