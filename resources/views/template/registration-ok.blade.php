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
        <td style="padding:20px 50px; font-size:25px; font-weight:bold; letter-spacing:-1px; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4;">
            대한환경공학회 {{ $reg->workshop->subject ?? '' }} <br>
            사전등록 완료 안내 드립니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px 30px; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
            {{ $reg->name_kr ?? '' }} 회원님. 안녕하십니까? <br>
            {{ $reg->workshop->subject ?? '' }} 사전등록 완료 안내 메일 드립니다. <br>
            영수증은 행사홈페이지 > 사전등록 조회 후 출력 가능합니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0;  font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        접수번호
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->regnum ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        대한환경공학회 홈페이지 회원여부
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ ($reg->user_chk ?? '') == 'Y' ? '회원' : '비회원' }}
                    </td>
                </tr>
                @if(($reg->user_chk ?? '') == 'Y')
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        대한환경공학회 회원인증
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->user->id ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        2025년 연회비 납부 여부
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        @if(($reg->fee_chk ?? '') == 'Y')
                        <p style="margin:0; padding:0; color:blue">완납</p>
                        @else
                        <p style="margin:0; padding:0; color:red">미납</p>
                        @endif
                    </td>
                </tr>
                @else
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        비회원 등록 비밀번호
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->user_password ?? '' }}
                    </td>
                </tr>
                @endif
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
                        {{ $reg->name_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        직장명 (소속)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->sosok_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        직위
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->position ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        이메일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->email ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        휴대폰번호
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->phone ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 50px 0;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        참가 구분
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['gubun'][$reg->gubun] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        등록 구분
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['category'][$reg->category]['name'] ?? '' }} - {{ number_format($workshopConfig['category'][$reg->category]['price']) ?? '' }}원
                    </td>
                </tr>

                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        결제 방법
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['payment_method'][$reg->payment_method] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        등록비
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; color:red; font-weight:700; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['category'][$reg->category]['price'] ? number_format($workshopConfig['category'][$reg->category]['price']): '' }}원
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        결제상태
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; color:red; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['payment_status'][$reg->payment_status] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        최초 등록일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->created_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        최종 등록일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->complete_at ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding:60px 0; text-align:center;">
            <a href="{{ env('APP_URL') }}/workshop/{{$reg->work_code}}/registration/search" target="_blank"><img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/btn_mail_print.png" alt=""></a>
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